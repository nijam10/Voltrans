<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 24px;
            background: #fff;
        }

        .header {
            display: block;
            text-align: right;
            border-bottom: 2px solid #333;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .logo {
            height: 50px;
        }

        .company-details {
            text-align: right;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .company-address {
            font-size: 11px;
            color: #555;
            line-height: 1.3;
        }

        .invoice-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .invoice-meta {
            font-size: 11px;
            color: #777;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .customer-info, .order-info {
            width: 48%;
        }

        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 6px;
        }

        address {
            font-style: normal;
            font-size: 11px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            font-size: 11px;
            padding: 4px 0;
        }

        .info-table .label {
            font-weight: bold;
            width: 45%;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .status-paid { background: #d4edda; color: #155724; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        .location-info {
            margin-bottom: 20px;
        }

        .location-item {
            font-size: 11px;
            margin-bottom: 8px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.items th, table.items td {
            border: 1px solid #ccc;
            padding: 6px;
            font-size: 11px;
        }

        table.items th {
            background: #f5f5f5;
            font-weight: bold;
        }

        table.items td.amount {
            text-align: right;
        }

        .totals {
            width: 100%;
            max-width: 320px;
            float: right;
            margin-top: 10px;
        }

        .totals td {
            padding: 4px 8px;
            font-size: 11px;
        }

        .totals .label {
            font-weight: bold;
        }

        .totals .final {
            font-weight: bold;
            font-size: 12px;
            border-top: 2px solid #333;
        }

        .payment-section {
            clear: both;
            margin-top: 20px;
            padding: 12px;
            background: #f9f9f9;
            border: 1px solid #ddd;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 11px;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
        }

        .payment-item .label {
            font-weight: bold;
        }

        .footer {
            clear: both;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }

        @media print {
            body { padding: 0; margin: 0; }
            .invoice-box { border: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <div class="header">
            <div class="company-details">
                <div class="company-name">Voltrans</div>
                <div class="company-address">
                    Jl. Ahmad Yani, Tlk. Tering<br>
                    Batam Kota, Kep. Riau 29461<br>
                    Indonesia
                </div>
            </div>
        </div>

        <!-- Invoice Title -->
        <h1 class="invoice-title">Invoice #{{ $order->order_code }}</h1>
        <div class="invoice-meta">Diterbitkan pada {{ $order->created_at->format('d/m/Y') }}</div>

        <!-- Customer & Order Info -->
        <div class="info-row">
            <div class="customer-info">
                <div class="section-title">Detail Pelanggan:</div>
                <address>
                    <strong>{{ $order->customer->name }}</strong><br>
                    Email: {{ $order->customer->email }}<br>
                    Telepon: {{ $order->phone_number }}
                </address>
            </div>
            <div class="order-info">
                <table class="info-table">
                    <tr>
                        <td class="label">Status Pesanan:</td>
                        <td>
                            <span class="status-badge status-{{ $payment && $payment->payment_status === 'paid' ? 'paid' : ($order->cancelled_at ? 'cancelled' : 'pending') }}">
                                {{ $payment && $payment->payment_status === 'paid' ? 'Lunas' : ($order->cancelled_at ? 'Dibatalkan' : 'Menunggu') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Pesanan:</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @if($order->cancelled_at)
                    <tr>
                        <td class="label">Tanggal Dibatalkan:</td>
                        <td>{{ $order->cancelled_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Locations -->
        <div class="location-info">
            <div class="section-title">Informasi Pemesanan:</div>
            @if($order->is_delivered)
                @php $delivery = json_decode($order->delivery_location, true); @endphp
                <div class="location-item">
                    <strong>Alamat Pengiriman:</strong><br>
                    @if(isset($delivery['type']))
                        @if($delivery['type'] === 'existing')
                            {{ $delivery['name'] ?? 'N/A' }}<br>
                            {{ $delivery['address'] ?? 'N/A' }}<br>
                            {{ $delivery['city'] ?? 'N/A' }}, {{ $delivery['province'] ?? 'N/A' }} {{ $delivery['postal_code'] ?? '' }}
                        @elseif($delivery['type'] === 'new')
                            {{ $delivery['name'] ?? 'N/A' }}<br>
                            {{ $delivery['address'] ?? 'N/A' }}<br>
                            {{ $delivery['city'] ?? 'N/A' }}, {{ $delivery['province'] ?? 'N/A' }} {{ $delivery['postal_code'] ?? '' }}
                        @endif
                    @else
                        Alamat tidak tersedia
                    @endif
                </div>
            @else
                <div class="location-item">
                    <strong>Lokasi Pengambilan:</strong><br>
                    Alamat Perusahaan (akan dikirimkan via email)
                </div>
            @endif
            
            <div class="location-item">
                <strong>Alamat Pengembalian:</strong><br>
                @php $return = json_decode($order->return_location, true); @endphp
                @if(isset($return['type']))
                    @if($return['type'] === 'same_as_shipping')
                        @if($order->is_delivered)
                            Sama dengan alamat pengiriman
                        @else
                            Sama dengan lokasi pengambilan (Alamat Perusahaan)
                        @endif
                    @elseif($return['type'] === 'existing')
                        {{ $return['name'] ?? 'N/A' }}<br>
                        {{ $return['address'] ?? 'N/A' }}<br>
                        {{ $return['city'] ?? 'N/A' }}, {{ $return['province'] ?? 'N/A' }} {{ $return['postal_code'] ?? '' }}
                    @elseif($return['type'] === 'new')
                        {{ $return['name'] ?? 'N/A' }}<br>
                        {{ $return['address'] ?? 'N/A' }}<br>
                        {{ $return['city'] ?? 'N/A' }}, {{ $return['province'] ?? 'N/A' }} {{ $return['postal_code'] ?? '' }}
                    @elseif($return['type'] === 'pickup')
                        {{ $return['location'] ?? 'N/A' }}
                    @endif
                @else
                    Lokasi pengembalian tidak tersedia
                @endif
            </div>
        </div>

        <!-- Items -->
        <table class="items">
            <thead>
            <tr>
                <th>Produk</th>
                <th>Periode Sewa</th>
                <th>Durasi (hari)</th>
                <th>Harga/Hari</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                @php
                    $startDate = \Carbon\Carbon::parse($item->started_at);
                    $endDate = \Carbon\Carbon::parse($item->ended_at);
                    $days = $startDate->diffInDays($endDate) + 1;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</td>
                    <td>{{ $days }}</td>
                    <td class="amount">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="amount">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <table class="totals">
            <tr>
                <td class="label">Subtotal:</td>
                <td class="amount">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Pajak (11%):</td>
                <td class="amount">Rp {{ number_format($tax, 0, ',', '.') }}</td>
            </tr>
            <tr class="final">
                <td class="label">Total:</td>
                <td class="amount">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Payment -->
        @if($payment)
        <div class="payment-section">
            <div class="section-title">Informasi Pembayaran:</div>
            <div class="payment-grid">
                <div class="payment-item">
                    <span class="label">Status:</span>
                    <span class="status-badge status-{{ $payment->payment_status === 'paid' ? 'paid' : 'pending' }}">
                        {{ $payment->payment_status === 'paid' ? 'Lunas' : 'Menunggu' }}
                    </span>
                </div>
                <div class="payment-item">
                    <span class="label">Metode:</span>
                    <span>{{ ucfirst($payment->payment_type) }}</span>
                </div>
                @if($payment->bank)
                <div class="payment-item">
                    <span class="label">Bank:</span>
                    <span>{{ strtoupper($payment->bank) }}</span>
                </div>
                @endif
                @if($payment->va_number)
                <div class="payment-item">
                    <span class="label">VA:</span>
                    <span>{{ $payment->va_number }}</span>
                </div>
                @endif
                @if($payment->paid_at)
                <div class="payment-item">
                    <span class="label">Tanggal:</span>
                    <span>{{ $payment->paid_at->format('d/m/Y H:i') }}</span>
                </div>
                @endif
                <div class="payment-item">
                    <span class="label">Jumlah:</span>
                    <span><strong>Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}</strong></span>
                </div>
            </div>
        </div>
        @endif
        <!-- Footer -->
        <div class="footer">
            <strong>Terima kasih telah memilih Voltrans!</strong><br>
            Ada pertanyaan? Hubungi kami di:<br>
            Email: voltrans.app@gmail.com | Telepon: 0778 5432115<br>
            © 2025 Voltrans. Hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
