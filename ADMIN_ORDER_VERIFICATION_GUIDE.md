# Panduan Verifikasi Pesanan - Admin Voltrans

## Overview
Sistem verifikasi pesanan memungkinkan admin untuk memeriksa dan menyetujui pesanan sebelum pelanggan dapat melakukan pembayaran. Ini memastikan kualitas layanan dan mencegah pesanan yang tidak valid.

## Alur Verifikasi Pesanan

### 1. Pesanan Masuk
- Pelanggan membuat pesanan melalui website
- Pesanan otomatis mendapat status "Menunggu Verifikasi"
- Admin menerima notifikasi real-time
- Badge merah muncul di menu "Pesanan" dengan jumlah pesanan pending

### 2. Verifikasi Pesanan
Admin dapat memverifikasi pesanan melalui beberapa cara:

#### A. Dashboard Widget
- Widget "Pesanan Menunggu Verifikasi" di dashboard admin
- Menampilkan daftar pesanan yang perlu diverifikasi
- Tombol "Verifikasi" dan "Tolak" langsung di widget

#### B. Halaman List Pesanan
- Klik menu "Pesanan" di sidebar
- Filter otomatis untuk status "Menunggu Verifikasi"
- Aksi verifikasi per pesanan atau bulk action

#### C. Detail Pesanan
- Klik "Lihat" pada pesanan
- Halaman detail lengkap dengan informasi pelanggan dan item
- Tombol verifikasi di header halaman

## Status Pesanan

### Menunggu Verifikasi (Warning/Orange)
- Pesanan baru yang belum diperiksa admin
- Pelanggan belum bisa melakukan pembayaran
- Memerlukan tindakan admin

### Dalam Proses (Primary/Blue)
- Pesanan telah diverifikasi admin
- Pelanggan dapat melakukan pembayaran
- Pesanan sedang diproses

### Selesai (Success/Green)
- Pembayaran telah selesai
- Pesanan telah diselesaikan

### Dibatalkan (Danger/Red)
- Pesanan ditolak oleh admin
- Alasan pembatalan tercatat
- Pelanggan akan diberitahu

## Aksi yang Tersedia

### Verifikasi Pesanan
1. Klik tombol "Verifikasi" (✓)
2. Konfirmasi aksi
3. Status berubah menjadi "Dalam Proses"
4. Pelanggan dapat melakukan pembayaran

### Tolak Pesanan
1. Klik tombol "Tolak" (✗)
2. Masukkan alasan penolakan (wajib)
3. Konfirmasi aksi
4. Status berubah menjadi "Dibatalkan"
5. Alasan pembatalan tersimpan

### Bulk Actions
- Pilih beberapa pesanan sekaligus
- Klik "Verifikasi Terpilih"
- Semua pesanan terpilih akan diverifikasi

## Notifikasi Sistem

### Notifikasi Real-time
- Admin menerima notifikasi saat ada pesanan baru
- Notifikasi muncul di dashboard admin
- Link langsung ke detail pesanan

### Email Notifikasi (Opsional)
- Dapat dikonfigurasi untuk mengirim email ke admin
- Template email dapat disesuaikan

## Monitoring dan Laporan

### Dashboard Statistics
- Total pemasukan dari pesanan selesai
- Jumlah pesanan menunggu verifikasi
- Jumlah customer baru
- Total pesanan keseluruhan

### Filter dan Pencarian
- Filter berdasarkan status
- Pencarian berdasarkan kode pesanan
- Filter tanggal pesanan
- Filter pelanggan

## Best Practices

### Verifikasi Pesanan
1. **Periksa Informasi Pelanggan**
   - Nama dan kontak valid
   - Alamat pengiriman jelas

2. **Periksa Item Pesanan**
   - Produk tersedia
   - Jumlah masuk akal
   - Harga sesuai

3. **Periksa Total Pembayaran**
   - Perhitungan diskon benar
   - Biaya pengiriman sesuai

### Penolakan Pesanan
1. **Alasan Jelas**
   - Berikan alasan spesifik
   - Gunakan bahasa yang sopan
   - Jelaskan langkah selanjutnya

2. **Dokumentasi**
   - Semua alasan penolakan tercatat
   - Timestamp pembatalan tersimpan

## Troubleshooting

### Pesanan Tidak Muncul di List
- Periksa filter status
- Pastikan pesanan memiliki status "menunggu_verifikasi"
- Refresh halaman

### Notifikasi Tidak Muncul
- Periksa pengaturan notifikasi browser
- Pastikan admin memiliki role yang benar
- Cek log sistem

### Error Saat Verifikasi
- Periksa koneksi database
- Pastikan pesanan masih dalam status yang benar
- Coba refresh halaman

## Kontak Support
Jika mengalami masalah dengan sistem verifikasi, hubungi tim IT atau buat ticket support.

---

**Catatan:** Sistem ini dirancang untuk memastikan kualitas layanan dan mencegah penipuan. Setiap keputusan verifikasi harus dilakukan dengan hati-hati dan sesuai dengan kebijakan perusahaan. 