@extends('template.shoppingTemplate')

@section('title', 'MyCrafts')

@section('style')

<style>
        .image-container {
height: 250px; /* Sesuaikan dengan tinggi yang diinginkan */
width: 100%; /* Lebar penuh */
display: flex;
justify-content: center;
align-items: center;
border: 1px solid #ddd;
overflow: hidden; /* Pastikan gambar tidak melampaui container */
}

.image-container img {
height: 100%; /* Isi tinggi container */
width: auto; /* Lebar disesuaikan dengan rasio gambar */
object-fit: contain; /* Pertahankan rasio gambar, tidak terpotong */
display: block;
max-width: 100%; /* Pastikan gambar tidak melebihi container */
}


.fruite-item {
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.fruite-item:hover {
transform: translateY(-5px);
box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}
</style>

@endsection


@section('content')

<div class="container-fluid fruite py-5">

    <div class="container py-5">
        <br><br><br><br>
        <h1 class="mb-4">Pembelian</h1>


            <h5 class="card-header">Transaksi berjalan</h5>
            <br>



            @for ($i=0; $i < count($pembelian); $i++ )
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    {{-- <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i> --}}
                    <div class="position-absolute" style="bottom: 0px; right: 0;">
                        @if ($pembelian[$i]->tipe_trans== "custom")

                        <p>Perkiraan Harga: <b>Rp. {{number_format($pembelian[$i]->perkiraan_harga, 0, ',', '.')}}</b></p>
                        @endif
                        @php
                        $harga = '';
                            if ($pembelian[$i]->harga <= 0 ) {
                                $harga = ' Belum ada';
                            }
                            else{
                                $harga ="Rp. ". number_format($pembelian[$i]->harga, 0, ',', '.');
                            }
                        @endphp
                        <p>Harga Fix :<span><b>{{$harga}}</b></span></p>
                        @if ($pembelian[$i]->harga_redesain != null)

                        <p>Harga Desain Baru :<span><b>Rp. {{number_format($pembelian[$i]->harga_redesain, 0, ',', '.')}}</b></span></p>
                        @endif


                    </div>
                    <div class="mb-4 pb-4 border-bottom border-secondary">
                        @php
                                $s = $pembelian[$i]->status;
                                $status = "";
                                $color = "";
                                if($s == 1){
                                    $status = "Belum Di konfirmasi";
                                    $color = "bg-warning";
                                }
                                else if($s == 2){
                                    $status = "Penjual Memberikan Perbaikan Desain";
                                    $color = "bg-info";
                                }
                                else if($s == 3){
                                    $status = "Menunggu Pembayaran";
                                    $color = "bg-danger";
                                }
                                else if($s == 4){
                                    $status = "Pembayaran Diterima";
                                    $color = "bg-success";
                                }
                                else if($s == 5){
                                    $status = "Dalam Pengiriman";
                                    $color = "bg-dark";
                                }

                            @endphp
                        <p class="mb-0">{{ \Carbon\Carbon::parse($pembelian[$i]->tgl_transaksi)->translatedFormat('j F Y') }} <b><span class="badge {{$color}}">{{$status}}</span></b></p>

                    </div>

                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-secondary rounded">
                            <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">{{$pembelian[$i]->nama_produk}}</h4>
                            <p class="m-0 pb-3">Tipe Transaksi: {{$pembelian[$i]->tipe_trans}}</p>

                        </div>
                    </div>
                    <br>
                    <div>
                        @if ($pembelian[$i]->tipe_trans == "custom")

                        <a href="{{url('/detailTransaksiCustom/'.$pembelian[$i]->id)}}" style="color: brown"><b>Lihat Detail Transaksi</b></a>
                        @else
                        <a href="{{url('/detailTransaksiNonCustom/'.$pembelian[$i]->id)}}" style="color: brown"><b>Lihat Detail Transaksi</b></a>

                        @endif
                    </div>
                </div>
            </div>
            <br>
            @endfor



    </div>
</div>

@endsection

