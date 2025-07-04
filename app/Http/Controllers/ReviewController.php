<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Enhanced validation with custom messages
            $validated = $request->validate([
                'order_item_id' => 'required|exists:order_items,id',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ], [
                'order_item_id.required' => 'Item pesanan tidak valid.',
                'order_item_id.exists' => 'Item pesanan tidak ditemukan.',
                'rating.required' => 'Rating harus diisi.',
                'rating.integer' => 'Rating harus berupa angka.',
                'rating.min' => 'Rating minimal adalah 1.',
                'rating.max' => 'Rating maksimal adalah 5.',
                'comment.max' => 'Komentar tidak boleh lebih dari 1000 karakter.',
            ]);

            // Get order item with relations
            $orderItem = OrderItem::with(['order', 'product'])
                ->where('id', $validated['order_item_id'])
                ->first();

            if (!$orderItem) {
                return redirect()->back()->with('error', 'Item pesanan tidak ditemukan.');
            }

            // Check if order item belongs to authenticated user
            if ($orderItem->order->customer_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengulas item ini.');
            }

            // Check if already reviewed
            if ($orderItem->review) {
                return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk item ini.');
            }

            // Check if order item is completed
            if ($orderItem->status !== 'selesai') {
                return redirect()->back()->with('error', 'Anda hanya dapat mengulas item yang sudah selesai.');
            }

            // Use database transaction for data integrity
            DB::beginTransaction();

            try {
                // Create review
                $review = Review::create([
                    'order_item_id' => $orderItem->id,
                    'product_id' => $orderItem->product_id,
                    'customer_id' => Auth::id(),
                    'rating' => $validated['rating'],
                    'comment' => $validated['comment'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);


                DB::commit();

                // Log successful review creation
                Log::info('Review created successfully', [
                    'review_id' => $review->id,
                    'user_id' => Auth::id(),
                    'rating' => $validated['rating']
                ]);

                return redirect()->back()->with('success', 'Ulasan berhasil dikirim! Terima kasih atas feedback Anda.');

            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Failed to create review', [
                    'error' => $e->getMessage(),
                    'user_id' => Auth::id(),
                    'order_item_id' => $validated['order_item_id']
                ]);
                
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan ulasan. Silakan coba lagi.');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error in review store', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi nanti.');
        }
    }

    /**
     * Update product's average rating
     */
    private function updateProductRating($productId)
    {
        try {
            $averageRating = Review::where('product_id', $productId)
                ->avg('rating');
            
            $totalReviews = Review::where('product_id', $productId)
                ->count();

            // Update product table if you have rating columns
            DB::table('products')
                ->where('id', $productId)
                ->update([
                    'average_rating' => round($averageRating, 2),
                    'total_reviews' => $totalReviews,
                    'updated_at' => now()
                ]);

        } catch (\Exception $e) {
            Log::warning('Failed to update product rating', [
                'product_id' => $productId,
                'error' => $e->getMessage()
            ]);
            // Don't fail the main operation if rating update fails
        }
    }

    /**
     * Show reviews for a specific product
     */
    public function index(Request $request, $productId = null)
    {
        try {
            $query = Review::with(['customer', 'product', 'orderItem'])
                ->orderBy('created_at', 'desc');

            if ($productId) {
                $query->where('product_id', $productId);
            }

            // Filter by authenticated user's reviews if requested
            if ($request->get('my_reviews')) {
                $query->where('customer_id', Auth::id());
            }

            $reviews = $query->paginate(10);

            return view('reviews.index', compact('reviews'));

        } catch (\Exception $e) {
            Log::error('Failed to load reviews', [
                'error' => $e->getMessage(),
                'product_id' => $productId
            ]);
            
            return redirect()->back()->with('error', 'Gagal memuat ulasan.');
        }
    }

    /**
     * Show a specific review
     */
    public function show(Review $review)
    {
        try {
            $review->load(['customer', 'product', 'orderItem']);
            
            return view('reviews.show', compact('review'));

        } catch (\Exception $e) {
            Log::error('Failed to load review', [
                'error' => $e->getMessage(),
                'review_id' => $review->id
            ]);
            
            return redirect()->back()->with('error', 'Gagal memuat ulasan.');
        }
    }

    /**
     * Update a review (if editing is allowed)
     */
    public function update(Request $request, Review $review)
    {
        try {
            // Check if user owns this review
            if ($review->customer_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah ulasan ini.');
            }

            // Check if review can still be edited (e.g., within 24 hours)
            if ($review->created_at->diffInHours(now()) > 24) {
                return redirect()->back()->with('error', 'Ulasan hanya dapat diubah dalam 24 jam setelah dibuat.');
            }

            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ], [
                'rating.required' => 'Rating harus diisi.',
                'rating.integer' => 'Rating harus berupa angka.',
                'rating.min' => 'Rating minimal adalah 1.',
                'rating.max' => 'Rating maksimal adalah 5.',
                'comment.max' => 'Komentar tidak boleh lebih dari 1000 karakter.',
            ]);

            DB::beginTransaction();

            try {
                $review->update([
                    'rating' => $validated['rating'],
                    'comment' => $validated['comment'] ?? null,
                    'updated_at' => now(),
                ]);

                // Update product rating
                $this->updateProductRating($review->product_id);

                DB::commit();

                Log::info('Review updated successfully', [
                    'review_id' => $review->id,
                    'user_id' => Auth::id()
                ]);

                return redirect()->back()->with('success', 'Ulasan berhasil diperbarui.');

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to update review', [
                'error' => $e->getMessage(),
                'review_id' => $review->id,
                'user_id' => Auth::id()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah ulasan.');
        }
    }
}