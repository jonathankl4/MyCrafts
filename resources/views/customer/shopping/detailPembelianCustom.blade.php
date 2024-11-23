@extends('template.shoppingTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Detail Transaksi')

@section('style')
    <style>
        .transaction-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .transaction-header {
            background-color: #f8f9fa;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px;
        }
        .transaction-body {
            padding: 20px;
        }
        .transaction-detail-label {
            font-weight: 600;
            color: #6c757d;
        }
        .transaction-detail-value {
            color: #212529;
        }

        .payment-section {
            background-color: #f1f3f5;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }
        .redesign-modal .modal-content {
            border-radius: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <br><br><br><br><br>
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 fw-bold">Detail Transaksi</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="card transaction-card">
                    <div class="card-header transaction-header">
                        <h5 class="mb-0"><b>Detail Pembelian</b></h5>
                    </div>

                    <div class="card-body transaction-body">
                        @php
                            $customStatus = '';
                            $statusColor = '';
                            if ($htrans->status == 1) {
                                $customStatus = 'Menunggu Konfirmasi Penjual';
                                $statusColor = 'bg-warning';
                            } elseif ($htrans->status == 2) {
                                $customStatus = 'Penjual Memberikan Perbaikan Desain';
                                $statusColor = 'bg-info';
                            } elseif ($htrans->status == 3) {
                                $customStatus = 'Menunggu Pembayaran';
                                $statusColor = 'bg-secondary';
                            } elseif ($htrans->status == 4) {
                                $customStatus = 'Pembayaran diterima, menunggu';
                                $statusColor = 'bg-primary';
                            } elseif ($htrans->status == 5) {
                                $customStatus = 'Pembelian di Siapkan';
                                $statusColor = 'bg-info';
                            } elseif ($htrans->status == 6) {
                                $customStatus = 'Dalam Pengiriman';
                                $statusColor = 'bg-primary';
                            } elseif ($htrans->status == 7) {
                                $customStatus = 'Transaksi Berhasil';
                                $statusColor = 'bg-success';
                            } elseif (in_array($htrans->status, [8, 9, 10])) {
                                $customStatus = 'Pembelian gagal';
                                $statusColor = 'bg-danger';
                            }
                        @endphp

                        <div class="mb-3">
                            <span class="transaction-detail-label d-block mb-2">Status Transaksi</span>
                            <span class="status-badge {{ $statusColor }} text-white">{{ $customStatus }}</span>
                            @if ($htrans->status == 2)
                                    <button class="btn" style="background-color: #bfb596; color: black"
                                        data-bs-toggle="modal" data-bs-target="#modalDesainBaru">Lihat Perbaikan
                                        Desain</button>
                                @endif
                        </div>

                        @if (in_array($htrans->status, [8, 9, 10]))
                            <div class="mb-3">
                                <span class="transaction-detail-label">Keterangan batal:</span>
                                <span class="transaction-detail-value">{{ $htrans->alasan_batal }}</span>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="transaction-detail-label">Tanggal Transaksi</span>
                                    <span class="transaction-detail-value d-block">{{ $htrans->tgl_transaksi }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="transaction-detail-label">Perkiraan Harga</span>
                                    <span class="transaction-detail-value d-block">
                                        Rp. {{ number_format($htrans->perkiraan_harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="transaction-detail-label">Ongkir</span>
                                    <span class="transaction-detail-value d-block">
                                        @if ($htrans->ongkir == null)
                                            Tunggu Konfirmasi penjual
                                        @else
                                            Rp. {{ number_format($htrans->ongkir, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="payment-section">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="transaction-detail-label">Harga Fix Desain Awal</span>
                                    @if ($htrans->harga <= 0)
                                        <span class="transaction-detail-value d-block">Belum Ada</span>
                                    @else
                                        <span id="hargalama" class="transaction-detail-value d-block">
                                            Rp. {{ number_format($htrans->harga, 0, ',', '.') }}
                                        </span>
                                        <span class="transaction-detail-value">
                                            Total: Rp {{ number_format($htrans->harga + $htrans->ongkir, 0, ',', '.') }}
                                        </span>
                                        @if ($htrans->status_pembayaran == 0)
                                            <button class="btn btn-dark mt-2" id="pay-button">Bayar</button>
                                        @endif
                                    @endif
                                </div>

                                @if ($htrans->harga_redesain != null)
                                <div class="col-md-6">
                                    <span class="transaction-detail-label">Harga Fix Desain Baru</span>
                                    <span id="hargabaru" class="transaction-detail-value d-block">
                                        Rp. {{ number_format($htrans->harga_redesain, 0, ',', '.') }}
                                    </span>
                                    <span class="transaction-detail-value">
                                        Total: Rp {{ number_format($htrans->harga_redesain + $htrans->ongkir, 0, ',', '.') }}
                                    </span>
                                    @if ($htrans->status_pembayaran == 0)
                                        <button class="btn btn-dark mt-2" id="pay-button2">Bayar</button>
                                    @endif
                                </div>
                                @endif
                            </div>

                            @if ($htrans->status_pembayaran == 3)
                                <span class="badge bg-danger mt-3">Waktu Pembayaran Habis</span>
                            @elseif ($htrans->status_pembayaran == 1)
                                <span class="badge bg-success mt-3">
                                    Pembayaran Berhasil ({{ $htrans->pilihan == 'baru' ? 'Desain Baru' : 'Desain Awal' }})
                                </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <span class="transaction-detail-label">Add On</span>
                            @foreach($dtrans as $item)
                                @if ($item->jenis == 'second' || $item->cek_redesain != 'yes')
                                    <div class="transaction-detail-value">
                                        - {{ $item->nama_item }}
                                        @if ($item->jenis != 'second')
                                            : {{ $item->jumlah }}
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <span class="transaction-detail-label">Finishing</span>
                            <span class="transaction-detail-value d-block">{{ $htrans->finishing }}</span>
                        </div>

                        <div class="mt-3">
                            <span class="transaction-detail-label">Alamat</span>
                            <span class="transaction-detail-value d-block">{{ $htrans->alamat }}</span>
                        </div>

                        <div class="mt-3">
                            <span class="transaction-detail-label">Nomor WhatsApp</span>
                            <span class="transaction-detail-value d-block">{{ $htrans->nomorTelepon }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card transaction-card">
                    <div class="card-header transaction-header">
                        <h5 class="mb-0"><b>Desain</b></h5>
                    </div>

                    <div class="card-body transaction-body">
                        <div class="">
                            @if (str_contains($htrans->nama_produk, 'lemari'))
                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh1) }}"
                                     style="width: 300px;height:450px">
                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh2) }}"
                                     style="width: 300px;height:450px">
                            @else
                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh1) }}"
                                    style="width: 650px">
                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh2) }}"
                                style="width: 650px">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Redesign Modal -->
    <div class="modal fade redesign-modal" id="modalDesainBaru" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perbaikan Desain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    @if ($htrans->fotoredesain != null)
                        <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoredesain) }}"
                             style="width: 300px;height:450px">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script style="text/javascript">
        // $('#pay-button').click(function(event) {
        //     event.preventDefault();

        //     $.post("{{ route('donation.pay') }}", {
        //         _method: 'POST',
        //         _token: '{{ csrf_token() }}',
        //         name: 'jojo',
        //         email: 'jojo@gmail.com',
        //         amount: 11000,
        //         note: 'kocak'
        //     });


        // });

        let htrans = @json($htrans);
        @if ($data1)
            document.getElementById('pay-button').addEventListener('click', function() {
                snap.pay('{{ $data1->snap_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);

                        $.ajax({
                            url: '{{ route('pembayaran') }}', // URL ke route untuk update membership
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                hasil: result,
                                idHtrans: htrans.id,
                                pilihan: 'awal' // Data paket yang dipilih
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    window.location.href =
                                        '{{ url('/customer/pembelian') }}'; // Redirect ke dashboard
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
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    onClose: function() {
                        alert('kemu menututp popup tanpa menyelesaikan pembayaran');
                    }
                });
            });
        @endif


        @if ($data2)
            document.getElementById('pay-button2').addEventListener('click', function() {
                snap.pay('{{ $data2->snap_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        $.ajax({
                            url: '{{ route('pembayaran') }}', // URL ke route untuk update membership
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                hasil: result,
                                idHtrans: htrans.id,
                                pilihan: 'baru' // Data paket yang dipilih
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    window.location.href =
                                        '{{ url('/customer/pembelian') }}'; // Redirect ke dashboard
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
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    onClose: function() {
                        alert('kemu menututp popup tanpa menyelesaikan pembayaran');
                    }
                });
            });
        @endif
    </script>

@endsection
