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

                            @if ($htrans->status == 6)
                                <div class="detail-row" style="float: right">
                                    <h5>Aksi</h5>
                                    <button class="btn " style="background-color: #69e0d3; color: black"
                                        data-bs-toggle='modal' data-bs-target='#modalPesananSampai'>Konfirmasi Pesanan
                                        Sampai</button>
                                    <div class="modal fade" id="modalPesananSampai" tabindex="-1"
                                        aria-labelledby="modalDesainBaruLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #d6c699">
                                                    <h5 class="modal-title" id="modalDesainBaruLabel">Konfirmasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Pesanan Sudah Sampai?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ url('/customer/pembelianSampai/' . $htrans->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">Sudah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($htrans->status == 12)
                                <div class="detail-row" style="float: right">
                                    <h5>Aksi</h5>
                                    <div class="col">

                                        <button class="btn " style="background-color: #69e0d3; color: black"
                                            data-bs-toggle='modal' data-bs-target='#modalPesananSelesai'>Selesaikan
                                            Pesanan</button>
                                        <button class="btn " style="background-color: #c26a6a; color: black"
                                            data-bs-toggle='modal' data-bs-target='#modalRetur'>Ajukan
                                            Retur</button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalPesananSelesai" tabindex="-1"
                                    aria-labelledby="modalPesananSelesai" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #d6c699">
                                                <h5 class="modal-title" id="modalDesainBaruLabel">Konfirmasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Setelah Pesanan Selesai, Retur sudah tidak bisa dilakukan</p>
                                                <p>Yakin Selesaikan pesanan?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <form action="{{ url('/customer/pembelianSelesai/' . $htrans->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit">Selesai</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalRetur" tabindex="-1" aria-labelledby="modalRetur"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('/customer/pengajuanRetur/' . $htrans->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-header" style="background-color: #d6c699">
                                                    <h5 class="modal-title" id="modalDesainBaruLabel">Pengajuan Retur</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="alasan" class="form-label"
                                                            style="font-weight: 500; color: #6c757d;">Alasan Retur</label>
                                                        <textarea name="alasanretur" id="alasanretur" class="form-control"
                                                            style="padding: 10px; border: 1px solid #ced4da; border-radius: 5px; width: 100%;" cols="30" rows="5"
                                                            placeholder="Masukkan alasan Retur..." required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>


                                                    <button class="btn btn-success" type="submit">Kirim
                                                        Pengajuan</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($htrans->status == 14)
                                <div class="detail-row" style="float: right">
                                    <h5>Aksi</h5>
                                    <div class="col">

                                        <button class="btn " style="background-color: #69e0d3; color: black"
                                            data-bs-toggle='modal' data-bs-target='#modalKirimBalik'>Kirim Balik Ke
                                            Seller</button>

                                    </div>

                                    <div class="modal fade" id="modalKirimBalik" tabindex="-1"
                                        aria-labelledby="modalKirimBalik" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ url('/customer/KirimBalik/' . $htrans->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-header" style="background-color: #d6c699">
                                                        <h5 class="modal-title" id="modalDesainBaruLabel">Pengajuan Retur
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="alasan" class="form-label"
                                                                style="font-weight: 500; color: #6c757d;">Nomor
                                                                Resi</label>
                                                            <input type="text" id="ResiBalik" name="ResiBalik"
                                                                class="form-control">
                                                            <span style="color: red">kosongkan jika tidak ada resi</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>


                                                        <button class="btn btn-success" type="submit">Kirim</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($htrans->status == 15)
                                <div class="detail-row" style="float: right">
                                    <h5>Aksi</h5>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#modalUbahResi"
                                        style="margin: 5px; background-color: #898063; color: black">
                                        Ubah Nomor Resi
                                    </button>
                                    <div class="modal fade" id="modalUbahResi" tabindex="-1"
                                        aria-labelledby="modalTolakPesananLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ url('/seller/pesanan/ubahResi/' . $htrans->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                        style="background-color: #bfb596; color: white;">
                                                        <h5 class="modal-title" id="modalTolakPesananLabel">Kirim Pesanan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="padding: 25px;">

                                                        <div class="mb-3">
                                                            <label for="resi" class="form-label"
                                                                style="font-weight: 500; color: #6c757d;">Nomor
                                                                Resi</label>
                                                            <input type="text" name="editresi" id="editresi"
                                                                class="form-control" value="{{ $htrans->nomor_resi }}">
                                                            <span style="color: red;">kosongkan jika tidak ada nomor
                                                                resi</span>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                            style="background-color: #6c757d; border-color: #6c757d;">Tutup</button>
                                                        <button type="submit" id="confirmOrder" class="btn btn-success"
                                                            style="background-color: #28a745; border-color: #28a745;">Konfirmasi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                                } elseif ($htrans->status == 4) {
                                    $customStatus = 'Pembayaran diterima, menunggu';
                                } elseif ($htrans->status == 5) {
                                    $customStatus = 'Pembelian di Siapkan';
                                } elseif ($htrans->status == 6) {
                                    $customStatus = 'Dalam Pengiriman';
                                } elseif ($htrans->status == 7) {
                                    $customStatus = 'Transaksi Selesai';
                                } elseif ($htrans->status == 8) {
                                    $customStatus = 'Pembelian gagal';
                                } elseif ($htrans->status == 9) {
                                    $customStatus = 'Pembelian gagal';
                                } elseif ($htrans->status == 10) {
                                    $customStatus = 'Pembelian gagal';
                                } elseif ($htrans->status == 11) {
                                    $customStatus = 'Menunggu Dikirim';
                                } elseif ($htrans->status == 12) {
                                    $customStatus = 'Pesanan Sampai';
                                } elseif ($htrans->status == 13) {
                                    $customStatus = 'Pengajuan Retur';
                                } elseif ($htrans->status == 14) {
                                    $customStatus = 'Retur Diterima';
                                } elseif ($htrans->status == 15) {
                                    $customStatus = 'Pengiriman Kembali';
                                } elseif ($htrans->status == 16) {
                                    $customStatus = 'Retur Ditolak, Pesanan Selesai';
                                }
                            @endphp



                            <div class="detail-row">
                                <span class="detail-label">Status Transaksi:</span>
                                <span class="status-label">{{ $customStatus }}</span>

                            </div>
                            @if (in_array($htrans->status, [8, 9, 10]))
                                <div class="detail-row">
                                    <span class="detail-label">Keterangan batal: </span>
                                    <span class="detail-value">
                                        {{ $htrans->alasan_batal }}
                                    </span>
                                </div>
                            @endif

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

                            @if (!in_array($htrans->status, [8, 9, 10]))

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
                            @endif

                            <div class="detail-row">
                                <span class="detail-label">Harga:</span>
                                <span class="detail-value">Rp. {{ number_format($htrans->harga, 0, ',', '.') }}</span>
                            </div>

                            @if (!in_array($htrans->status, [8, 9, 10]))
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
                            @endif



                            @if ($htrans->status == 3)
                                <button id="pay-button" class="btn btn-dark">Bayar</button>
                            @endif
                            @if ($htrans->status_pembayaran == 1)
                                <span class="badge " style="background-color: #00c9ab"> Pembayaran Berhasil</span>
                            @elseif ($htrans->status_pembayaran == 3)
                                <span class="badge " style="background-color: #00c9ab"> Waktu Pembayran Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Desain Baru -->
    <div class="modal fade" id="modalDesainBaru" tabindex="-1" aria-labelledby="modalDesainBaruLabel"
        aria-hidden="true">
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
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
                                    window.location.href =
                                        '{{ url('/customer/pembelian') }}';
                                } else {
                                    alert(
                                        'Pembayaran berhasil, tapi ada masalah dalam pembaruan membership.'
                                        );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat memperbarui membership.');
                            }
                        });
                    },
                    onPending: function(result) {},
                    onError: function(result) {
                        console.error('Payment error:', result);
                        alert('Terjadi kesalahan dalam pembayaran.');
                    },
                    onClose: function() {
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                    }
                });
            });
        @endif
    </script>
@endsection
