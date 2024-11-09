@extends('template.shoppingTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Detail Transaksi')

@section('style')
    <style>

    </style>
@endsection




@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <br><br><br><br><br><br><br>
        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Detail Transaksi</h2>

            <div class="row">

                <div class="col-md-6" style="overflow: auto; z-index: 3;">
                    <div class="card">
                        <h5 class="card-header"><b>Detail Pembelian</b></h5>

                        <div style="padding: 15px ;color: black">
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
                                } else if($htrans->status == 6){
                                    $customStatus = 'Dalam Pengiriman';
                                } else if($htrans->status == 7){
                                    $customStatus = 'Transaksi Berhasil';
                                } else if($htrans->status == 8){
                                    $customStatus = 'Pembelian gagal';
                                }
                            @endphp
                            <div class="row">
                                <span style="font-size: 16px"><b>Status Transaksi</b></span>
                                <span>{{ $customStatus }} </span>
                                @if ($htrans->status == 2)
                                    <button class="btn" style="background-color: #bfb596; color: black"
                                        data-bs-toggle="modal" data-bs-target="#modalDesainBaru">Lihat Perbaikan
                                        Desain</button>
                                @endif
                            </div>
                            <br>
                            <div class="row">
                                <span style="font-size: 16px"><b>Tanggal Transaksi</b></span>
                                <span>{{ $htrans->tgl_transaksi }}</span>
                            </div>


                            <br>
                            <div class="row">
                                <span style="font-size: 16px"><b>Perkiraan Harga</b></span>
                                <span>Rp. {{ number_format($htrans->perkiraan_harga, 0, ',', '.') }} </span>
                            </div>
                            <br>
                            <div class="row">
                                <span style="font-size: 16px"><b>Ongkir</b></span>
                                @if ($htrans->ongkir == null)
                                    <span>Tunggu Konfirmasi penjual</span>
                                    @else

                                    <span>Rp. {{ number_format($htrans->ongkir, 0, ',', '.') }} </span>
                                @endif
                            </div>
                            <br>
                            <div class="row">



                                <div class="col">
                                    <span style="font-size: 20px"><b>Harga Fix desain awal</b></span>
                                    @if ($htrans->harga <= 0)
                                        <br>
                                        <span>Belum Ada </span>
                                    @else
                                        <br>
                                        <span id="hargalama">Rp. {{ number_format($htrans->harga, 0, ',', '.') }}
                                        </span>
                                        @if ($htrans->status_pembayaran == 0)

                                        <button class="btn btn-dark" id="pay-button">Bayar</button>
                                        @endif
                                    @endif
                                </div>
                                <div class="col">
                                    @if ($htrans->harga_redesain != null)
                                        <span style="font-size: 20px"><b>Harga Fix Desain Baru</b></span>
                                        <br>
                                        <span id="hargabaru">Rp.
                                            {{ number_format($htrans->harga_redesain, 0, ',', '.') }} </span>
                                            @if ($htrans->status_pembayaran == 0)
                                        <button class="btn btn-dark" id="pay-button2">Bayar</button>
                                        @endif
                                    @endif
                                </div>
                                @if ($htrans->status_pembayaran == 3)
                                <span style="font-size: 20px" class="btn"><b>Waktu Pembayaran Habis</b></span>
                                @elseif ($htrans->status_pembayaran == 1)
                                    @if ($htrans->pilihan == 'baru')

                                    <span style="font-size: 20px" class="btn btn-dark"><b>Pembayaran Berhasil (Desain Baru)</b></span>
                                    @else
                                    <span style="font-size: 20px" class="btn btn-dark"><b>Pembayaran Berhasil (Desain Awal)</b></span>

                                    @endif
                                @endif
                                {{-- <button id="pay-button">bayar</button> --}}

                                @if ($htrans->harga_redesain != null && $htrans->status_pembayaran == 0 )
                                    <label for="" class="badge bg-warning" style="margin-top: 10px">Silahkan Pilih Bayar
                                        dengan desain baru atau tetap dengan desain lama </label>
                                @endif
                            </div>
                            <br>
                            <div>

                                <span style="font-size: 16px"><b>Add On</b></span>
                                @for ($i = 0; $i < count($dtrans); $i++)
                                    @if ($dtrans[$i]->jenis == 'second')
                                        <div>
                                            <span><b> </b> </span> <span>- {{ $dtrans[$i]->nama_item }} </span>

                                        </div>
                                    @else
                                        @if ($dtrans[$i]->cek_redesain != 'yes')
                                            <div>
                                                <span><b>- {{ $dtrans[$i]->nama_item }} :</b> </span>
                                                <span>{{ $dtrans[$i]->jumlah }} </span>
                                            </div>
                                        @endif
                                    @endif
                                @endfor
                            </div>









                        </div>



                    </div>
                </div>
                <div class="col-md-6" style="z-index: 3">
                    <div class="card">
                        <h5 class="card-header"><b>Desain</b></h5>
                        <div style="padding: 15px">

                            <div class="row">
                                @if (str_contains($htrans->nama_produk, 'lemari'))

                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh1) }}"
                                    style="width: 300px;height:450px">

                                <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh2) }}"
                                    style="width: 300px;height:450px">
                                    @else
                                    <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh1) }}"
                                        style="">

                                    <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoh2) }}"
                                        style="">

                                @endif

                            </div>


                        </div>



                    </div>
                </div>
            </div>





            {{-- <img id="template" src="{{url("img/test.png")}}" style="width: 1000px"/> --}}


        </div>


    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>

    <div class="modal fade" id="modalDesainBaru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title "> Perbaikan Desain </h2>

                    @if ($htrans->fotoredesain != null)
                        <img src="{{ url('/storage/hasilcustom/' . $htrans->fotoredesain) }}"
                            style="width: 300px;height:450px">
                    @endif
                    {{-- <form id="myForm">
                    <div class="mb-3">
                        <label class="form-label">Harga Fix</label>
                        <input type="number" class="form-control" id="hargafix" name="hargafix" required />
                        <span style="color: red">*Harga Fix yang harus dibayarkan oleh customer</span>
                    </div>
                    <button class="btn" id="terimaPesanan" style="background-color: #3c7e63; color: white">Kirim</button>
                </form> --}}
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
