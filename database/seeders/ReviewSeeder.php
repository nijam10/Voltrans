<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $orderItems = OrderItem::where('status', 'selesai')->get();
        $products = Product::all();

        foreach ($orderItems->take(100) as $item) {
            $user = $item->order->user ?? $users->random();
            Review::create([
                'order_item_id' => $item->id,
                'product_id' => $item->product_id,
                'customer_id' => $user->id,
                'rating' => rand(4, 5),
                'comment' => fake()->sentence(50),
            ]);
        }

        foreach ($products->take(50) as $product) {
            $user = $users->random();
            Review::create([
                'order_item_id' => null,
                'product_id' => $product->id,
                'customer_id' => $user->id,
                'rating' => rand(3, 5),
                'comment' => fake()->sentence(50),
            ]);
        }
    }
} 