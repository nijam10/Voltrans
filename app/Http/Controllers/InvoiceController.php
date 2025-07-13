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
        $order = Order::with(['items.product', 'customer'])
            ->where('order_code', $orderCode)
            ->firstOrFail();
        
        // Find the payment
        $payment = Payment::where('order_code', $orderCode)->first();
        
        // Calculate totals if not already calculated
        if ($order->total_amount == 0) {
            $order->calculateAndUpdateTotals();
        }
        
        // Generate PDF
        $pdf = Pdf::loadView('export.invoice-pdf', [
            'order' => $order,
            'payment' => $payment,
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Download the PDF
        return $pdf->download("invoice-{$orderCode}.pdf");
    }
    
    public function viewPdf($orderCode)
    {
        // Find the order with related data
        $order = Order::with(['items.product', 'customer'])
            ->where('order_code', $orderCode)
            ->firstOrFail();
        
        // Find the payment
        $payment = Payment::where('order_code', $orderCode)->first();
        
        // Calculate totals if not already calculated
        if ($order->total_amount == 0) {
            $order->calculateAndUpdateTotals();
        }
        
        // Generate PDF
        $pdf = Pdf::loadView('export.invoice-pdf', [
            'order' => $order,
            'payment' => $payment,
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Return the PDF for viewing in browser
        return $pdf->stream("invoice-{$orderCode}.pdf");
    }
} 