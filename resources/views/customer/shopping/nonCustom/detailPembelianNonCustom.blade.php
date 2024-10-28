@extends('template.shoppingTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Detail Transaksi')

@section('style')
    <style>
        .content-wrapper {
            padding: 40px;
            background-color: #f7f7f7;
        }

        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            padding: 20px;
        }

        .card-body {
            padding: 30px;
            background-color: #fff;
            color: #333;
        }

        .detail-row {
            margin-bottom: 20px;
        }

        .detail-label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #6c757d;
        }

        .detail-value {
            font-size: 16px;
            color: #555;
        }

        .status-label {
            background-color: #f0deb4;
            color: #000;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
        }

        .modal-body {
            padding: 20px;
        }

        .btn-close {
            background-color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container py-5">
            <br><br>
            <h2 class="fw-bold text-center mb-4"></h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">Detail Pembelian</h5>
                        <div class="card-body">
                            @php
                                $customStatus = '';
                                $pesan = '';
                                if ($htrans->status == 1) {
                                    $customStatus = 'Menunggu Konfirmasi Penjual';
                                } elseif ($htrans->status == 2) {
                                    $customStatus = 'Penjual Memberikan Perbaikan Desain';
                                    if ($htrans->status_redesain == 1) {
                                        $pesan = ' Dengan ';
                                    }
                                } elseif ($htrans->status == 3) {
                                    $customStatus = 'Menunggu Pembayaran';
                                } else if($htrans->status == 4){
                                    $customStatus = 'Pembayaran diterima, menunggu';
                                } else if($htrans->status == 5){
                                    $customStatus = 'Pembelian di Siapkan';
                                }
                            @endphp

                            <div class="detail-row">
                                <span class="detail-label">Status Transaksi:</span>
                                <span class="status-label">{{ $customStatus }}</span>
                                @if ($htrans->status == 2)
                                    <button class="btn btn-custom mt-3" data-bs-toggle="modal" data-bs-target="#modalDesainBaru">Lihat Perbaikan Desain</button>
                                @endif
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Tanggal Transaksi:</span>
                                <span class="detail-value">{{ $htrans->tgl_transaksi }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Alamat Pengiriman:</span>
                                <span class="detail-value">{{ $htrans->alamat }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Produk:</span>
                                <span class="detail-value">Nama: {{ $htrans->nama_produk }}</span><br>
                                <span class="detail-value">Jumlah: {{ $htrans->jumlah }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Ongkir:</span>
                                <span class="detail-value">
                                    @if ($htrans->ongkir == null)
                                        Menunggu Konfirmasi
                                    @else
                                        Rp. {{ number_format($htrans->ongkir, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Harga:</span>
                                <span class="detail-value">Rp. {{ number_format($htrans->harga, 0, ',', '.') }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Total:</span>
                                <span class="total-amount">
                                    @if ($htrans->ongkir == null)
                                        Menunggu Konfirmasi
                                    @else
                                        Rp. {{ number_format($htrans->ongkir + $htrans->harga, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            @if ($htrans->status == 3)

                            <button id="pay-button" class="btn btn-dark">Bayar</button>
                            @endif
                            @if ($htrans->status_pembayaran == 1)
                            <span class="badge " style="background-color: #00c9ab"> Pembayaran Berhasil</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Desain Baru -->
    <div class="modal fade" id="modalDesainBaru" tabindex="-1" aria-labelledby="modalDesainBaruLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDesainBaruLabel">Perbaikan Desain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Desain perbaikan ditampilkan di sini...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script>
        let htrans = @json($htrans);
        @if ($data1 && $htrans->status == 3)
            document.getElementById('pay-button').addEventListener('click', function() {
                snap.pay('{{ $data1->snap_token }}', {
                    onSuccess: function(result) {
                        $.ajax({
                            url: '{{ route('pembayaran') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                hasil: result,
                                idHtrans: htrans.id,
                                pilihan: 'jadi'
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    window.location.href = '{{ url('/customer/pembelian') }}';
                                } else {
                                    alert('Pembayaran berhasil, tapi ada masalah dalam pembaruan membership.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat memperbarui membership.');
                            }
                        });
                    },
                    onPending: function(result) {},
                    onError: function(result) {},
                    onClose: function() {
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                    }
                });
            });
        @endif
    </script>
@endsection
