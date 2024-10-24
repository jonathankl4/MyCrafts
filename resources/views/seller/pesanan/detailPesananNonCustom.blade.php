@extends('template.MasterDesain')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Detail Pesanan')

@section('style')
    <style>



    </style>
@endsection

@section('sidebar')

    @include('seller.template.sidebar')

@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Detail Pesanan</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}
            <div class="row" style="padding: 10px">
                <div class="col-md-4">
                    <div class="card " style="padding: 15px">



                        <div class="row">
                            <span>Tanggal dan Status Transaksi</span>
                            <span style="font-size: 20px"><b>
                                    {{ \Carbon\Carbon::parse($detail->tgl_transaksi)->translatedFormat('j F Y') }}
                                </b></span>
                                @php
                                $s = $detail->status;
                                $status = '';
                                        $color = '';
                                        if ($s == 1) {
                                            $status = 'Belum Di konfirmasi';
                                            $color = 'bg-warning';
                                        } elseif ($s == 2) {
                                            $status = 'Pengajuan Perbaikan desain, Menunggu Pembayaran';
                                            $color = 'bg-secondary';
                                        } elseif ($s == 3) {
                                            $status = 'Menunggu Pembayaran Customer';
                                            $color = 'bg-info';
                                        } elseif ($s == 4) {
                                            $status = 'Dalam Proses Produksi';
                                            $color = 'bg-success';
                                        } elseif ($s == 5) {
                                            $status = 'Siap Dikirim';
                                            $color = 'bg-dark';
                                        } elseif ($s == 6) {
                                            $status = 'Dalam Pengiriman';
                                            $color = 'bg-dark';
                                        } elseif ($s == 7) {
                                            $status = 'Pesanan Selesai';
                                            $color = 'bg-dark';
                                        } elseif ($s == 8) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-dark';
                                        } elseif ($s == 9) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-dark';
                                        } elseif ($s == 11) {
                                            $status = 'Sudah Dibayar, Belum di Konfirmasi';
                                            $color = 'bg-dark';
                                        }

                            @endphp
                            <td style="font-size: 16px"><b><span class="badge {{$color}}">{{$status}}</span></b></td>
                        </div>
                        <br>
                        <div class="row">
                            <span>Tipe Transaksi</span>
                            <span style="font-size: 20px"><b>{{ $detail->tipe_trans }}</b> </span>
                        </div>
                        <br>
                        <div class="row">
                            <span>Detail Produk</span>
                            <div class="col">
                                <img src="{{ url('/storage/imgProduk/' . $produk->foto_produk1) }}"
                                style="width: 100px;height:100px">


                            </div>
                            <div class="col">
                                <span style="font-size: 20px"><b>{{ $detail->nama_produk }}</b> </span>
                                <br>
                                <span style="font-size: 20px"><b>Qty: {{ $detail->jumlah }}</b>

                            </div>
                            </span>
                        </div>
                        <br>
                        <div class="row">
                            <span>Harga</span>
                            <span style="font-size: 20px"><b>Rp.
                                    {{ number_format($detail->harga, 0, ',', '.') }}</b> </span>
                        </div>
                        <br>
                        <div class="row">
                            <span style="font-size: 20px"><b>Catatan User</b></span>
                            <span> {{ $detail->catatan }} </span>
                        </div>

                    </div>
                    <br>


                </div>

                <br><br>
                <div class="col-md-8">

                    <div class="card " style="padding: 15px">
                        <h3 class="card-header"><b>Konfirmasi</b></h3>

                        <button class="btn"   data-bs-toggle="modal" data-bs-target="#modalTerimaPesanan"
                        style="margin: 5px; background-color: #898063; color: black">
                            Terima Pesanan
                        </button>
                        {{-- Tolak Pesanan --}}
                        <a href="{{ url('/seller/custom/redesain/' . $detail->id) }}" class="btn btn-danger"
                            style="margin: 5px;background-color: #fb8d76; color: black ">Batalkan Pesanan</a>

                    </div>
                    <br>
                    <div class="card" style="padding: 15px">
                        <div class="row">

                            <label for="" style="font-size: 20px"><b>Alamat Pengiriman</b></label>
                            <label for="">{{$detail->alamat}}</label>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" style="font-size: 20px"><b>Nomor Telepon</b></label>
                            <label for="">{{$detail->nomorTelepon}}</label>
                        </div>
                    </div>
                </div>
            </div>







        </div>

        <div class="modal fade" id="modalTerimaPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title text-primary"> Terima Pesanan </h2>

                    <form id="myForm">
                        <div class="mb-3">
                            <label class="form-label">Harga Fix</label>
                            <input type="number" class="form-control" id="hargafix" name="hargafix" required />
                            <span style="color: red">*Harga Fix yang harus dibayarkan oleh customer</span>
                        </div>
                        <button class="btn" id="terimaPesanan" style="background-color: #3c7e63; color: white">Terima</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
        </div>






    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tMebel').DataTable();


        });
    </script>

    <script>

        let htrans = @json($detail);


document.getElementById('terimaPesanan').addEventListener('click', function(event) {
        // Ambil form element
        const form = document.getElementById('myForm');

        // Cek validasi form
        if (form.checkValidity()) {
            event.preventDefault(); // Mencegah submit default jika valid

            const fixHarga = document.getElementById('hargafix').value;

            fetch('/seller/custom/terimaPesanan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        fixHarga: fixHarga,
                        id_htrans: htrans.id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ url('/seller/pesanan') }}" ;
                    } else {
                        alert("Gagal mengirim data");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim data');
                });
        } else {
            // Jika form tidak valid, browser akan menampilkan pesan kesalahan
            form.reportValidity(); // Menampilkan pesan error bawaan browser
        }
    });
    </script>
@endsection
