<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function exportPdf($orderCode)
    {
        // Find the order with related data
        $order = Order::with(['items.product', 'customer', 'discount'])
            ->where('order_code', $orderCode)
            ->firstOrFail();
        
        // Find the payment
        $payment = Payment::where('order_code', $orderCode)->first();
        
        // Calculate totals
        $subtotal = $order->items->sum('subtotal');
        $tax = $subtotal * 0.11; // 11% Tax
        $discountAmount = 0;
        if ($order->discount) {
            $discountAmount = $order->discount->calculateDiscountAmount($subtotal + $tax);
        }
        $total = $subtotal + $tax - $discountAmount;
        
        // Generate PDF
        $pdf = Pdf::loadView('export.invoice-pdf', [
            'order' => $order,
            'payment' => $payment,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discountAmount' => $discountAmount,
            'total' => $total,
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Download the PDF
        return $pdf->download("invoice-{$orderCode}.pdf");
    }
    
    public function viewPdf($orderCode)
    {
        // Find the order with related data
        $order = Order::with(['items.product', 'customer', 'discount'])
            ->where('order_code', $orderCode)
            ->firstOrFail();
        
        // Find the payment
        $payment = Payment::where('order_code', $orderCode)->first();
        
        // Calculate totals
        $subtotal = $order->items->sum('subtotal');
        $tax = $subtotal * 0.11; // 11% tax
        $discountAmount = 0;
        if ($order->discount) {
            $discountAmount = $order->discount->calculateDiscountAmount($subtotal + $tax);
        }
        $total = $subtotal + $tax - $discountAmount;
        
        // Generate PDF
        $pdf = Pdf::loadView('export.invoice-pdf', [
            'order' => $order,
            'payment' => $payment,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discountAmount' => $discountAmount,
            'total' => $total,
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Return the PDF for viewing in browser
        return $pdf->stream("invoice-{$orderCode}.pdf");
    }
} 