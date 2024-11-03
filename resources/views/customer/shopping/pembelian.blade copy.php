@extends('template.shoppingTemplate')

@section('title', 'MyCrafts')

@section('style')

    <style>
        .image-container {
            height: 250px;
            /* Sesuaikan dengan tinggi yang diinginkan */
            width: 100%;
            /* Lebar penuh */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ddd;
            overflow: hidden;
            /* Pastikan gambar tidak melampaui container */
        }

        .image-container img {
            height: 100%;
            /* Isi tinggi container */
            width: auto;
            /* Lebar disesuaikan dengan rasio gambar */
            object-fit: contain;
            /* Pertahankan rasio gambar, tidak terpotong */
            display: block;
            max-width: 100%;
            /* Pastikan gambar tidak melebihi container */
        }


        .fruite-item {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .fruite-item:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }
        .nav-link{
            color: black;


        }

        .nav-item :hover{
            color: #898063
        }




    </style>

@endsection


@section('content')

    <div class="container-fluid fruite py-5">

        <div class="container py-5">
            <br><br><br><br>
            <h1 class="mb-4">Pembelian</h1>



            <div class="">

                <div class="nav-align-top mb-4" >
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'semua' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=semua') }}">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'berjalan' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan') }}">Berjalan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'berhasil' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berhasil') }}">Berhasil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'tidak_berhasil' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=tidak_berhasil') }}">Tidak Berhasil</a>
                        </li>



                    </ul>
                    @if($status == 'berjalan')
<ul class="nav nav-pills mt-3">
    <li class="nav-item">
        <a class="nav-link {{ $sub_status == null ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan') }}">Semua</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $sub_status == 'menunggu_konfirmasi' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan&sub_status=menunggu_konfirmasi') }}">Menunggu Konfirmasi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $sub_status == 'sedang_produksi' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan&sub_status=sedang_produksi') }}">Sedang di Produksi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $sub_status == 'siap_dikirim' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan&sub_status=siap_dikirim') }}">Siap Dikirim</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ $sub_status == 'dikirim' ? 'active' : '' }}" href="{{ url('/customer/pembelian?status=berjalan&sub_status=dikirim') }}">Dikirim</a>
    </li>
</ul>
@endif

                </div>
            </div>

            <div class="table-responsive">
                <table id="tMebel" class="table">
                    <thead>
                        <tr>
                            <th>Tgl Transaksi</th>
                            <th>Pembelian</th>
                            <th>Harga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($pembelian); $i++)
                            <tr>
                                <td>
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($pembelian[$i]->tgl_transaksi)->translatedFormat('j F Y, H:i') }}


                                    </p>
                                </td>

                                <!-- Kolom Gambar dan Detail Produk -->
                                <td>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="bg-secondary rounded">
                                            <!-- Gambar Produk -->
                                            <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                                style="width: 100px; height: 100px;" alt="">
                                        </div>
                                        <div class="ms-4">
                                            <!-- Nama Produk -->
                                            <h4 class="text-dark">{{ $pembelian[$i]->nama_produk }} </h4>
                                            <!-- Tipe Transaksi -->
                                            <p class="m-0">Tipe Transaksi: {{ $pembelian[$i]->tipe_trans }} </p>

                                        </div>


                                    </div>
                                </td>

                                <!-- Kolom Harga Fix -->
                                <td>
                                    @if ($pembelian[$i]->tipe_trans == 'custom')
                                        <p>Perkiraan Harga: <b>Rp.
                                                {{ number_format($pembelian[$i]->perkiraan_harga, 0, ',', '.') }}</b>
                                        </p>
                                    @endif
                                    @php
                                        $harga = '';
                                        if ($pembelian[$i]->harga <= 0) {
                                            $harga = ' Belum ada';
                                        } else {
                                            $harga = 'Rp. ' . number_format($pembelian[$i]->harga, 0, ',', '.');
                                        }
                                    @endphp
                                    <p>Harga Fix :<span><b>{{ $harga }}</b></span></p>
                                    @if ($pembelian[$i]->harga_redesain != null)
                                        <p>Harga Desain Baru :<span><b>Rp.
                                                    {{ number_format($pembelian[$i]->harga_redesain, 0, ',', '.') }}</b></span>
                                        </p>
                                    @endif
                                </td>

                                <!-- Kolom Link Detail Transaksi -->
                                <td>
                                    @if ($pembelian[$i]->tipe_trans == 'custom')
                                        <a href="{{ url('/detailTransaksiCustom/' . $pembelian[$i]->id) }}"
                                            style="color: brown"><b>Lihat Detail Transaksi</b></a>
                                    @else
                                        <a href="{{ url('/detailTransaksiNonCustom/' . $pembelian[$i]->id) }}"
                                            style="color: brown"><b>Lihat Detail Transaksi</b></a>
                                    @endif
                                            <br>
                                            @php
                                            $s = $pembelian[$i]->status;
                                            $status = '';
                                            $color = '';
                                            if ($s == 1) {
                                                $status = 'Menunggu Konfirmasi';
                                                $color = 'bg-warning';
                                            } elseif ($s == 2) {
                                                $status = 'Seller memberikan Perbaikan desain, Konfirmasi dan bayar';
                                                $color = 'bg-danger';
                                            } elseif ($s == 3) {
                                                $status = 'Menunggu Pembayaran Customer';
                                                $color = 'bg-info';
                                            } elseif ($s == 4) {
                                                $status = 'Dalam Proses Produksi';
                                                $color = 'bg-warning';
                                            } elseif ($s == 5) {
                                                $status = 'Menunggu Dikirim';
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
                                                $status = 'Belum di Konfirmasi';
                                                $color = 'bg-warning';
                                            }


                                        @endphp
                                        <b><span class="badge {{ $color }}">{{ $status }}</span></b>
                                </td>



                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>





        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#tMebel').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });


        });
    </script>
@endsection
