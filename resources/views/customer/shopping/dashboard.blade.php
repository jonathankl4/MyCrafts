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

        #btnLebihBanyak1:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-title {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2em;
            /* Adjust the line-height if needed */
            max-height: 2.4em;
            /* Line height * number of lines */
        }

        .product-item {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .filter-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .size-badge {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 4px;
        background: #f8f9fa;
        margin-right: 5px;
    }
    </style>
@endsection

@section('content')

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">ini dashboard</h4>
                    <h1 class="mb-5 display-3 " style="color: black">Temukan Meja dan lemari terbaikmu</h1>
                    {{-- <div class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                </div> --}}
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('img/lemari.jpg') }}" class="img-fluid w-100 h-100 bg-secondary rounded"
                                    alt="First slide">
                                {{-- <a href="#" class="btn px-4 py-2 text-white rounded">Lemari</a> --}}
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('img/meja.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                {{-- <a href="#" class="btn px-4 py-2 text-white rounded">Meja</a> --}}
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Featurs Section Start -->

    <!-- Featurs Section End -->

    <!--  Shop Start-->


    <!--  Shop 2 Start-->
    <div class="container-fluid fruite">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Produk Custom</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">

                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" href="{{ url('/explore-custom-produk') }}"
                                    id="btnLebihBanyak1">
                                    <span class="text-dark" style="width: 200px;">Tampilkan Lebih Banyak</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @foreach ($random2 as $produk)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            {{-- <a href="{{ url('/custom/' . $random2[$i]->id) }}"> --}}
                                            <a href="{{ url('/dc/' . $produk->id) }}">
                                                <div class="product-item">
                                                    <div class="image-container" style="padding: 5px">
                                                        @if ($produk->kode == 'lemari1')
                                                            <img src="{{ url('img/lemari1/lemari1.png') }}"
                                                                class="img-fluid" alt="">
                                                        @elseif ($produk->kode == 'lemari2')
                                                            <img src="{{ url('img/lemari2/lemari2.png') }}"
                                                                class="img-fluid" alt="">
                                                        @elseif($produk->kode == 'lemari3')
                                                            <img src="{{ url('img/lemari3/lemari3.png') }}"
                                                                class="img-fluid" alt="">
                                                        @elseif($produk->kode == 'meja1')
                                                            <img src="{{ url('img/meja1/mj.png') }}" class="img-fluid"
                                                                alt="">
                                                        @elseif($produk->kode == 'meja2')
                                                            <img src="{{ url('img/meja2/meja2samping.png') }}"
                                                                class="img-fluid" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="p-4">
                                                        <h4>{{ $produk->nama_produk }}</h4>
                                                        <div class="d-flex mb-3 flex-wrap">
                                                            @if (str_contains(strtolower($produk->kode), 'lemari'))
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->panjang_min }}-{{ $produk->panjang_max }}cm
                                                                    (Kedalaman)
                                                                </span>
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->lebar_min }}-{{ $produk->lebar_max }}cm
                                                                    (Lebar)
                                                                </span>
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->tinggi_min }}-{{ $produk->tinggi_max }}cm
                                                                    (Tinggi)
                                                                </span>
                                                            @else
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->panjang_min }}-{{ $produk->panjang_max }}cm
                                                                    (Panjang)
                                                                </span>
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->lebar_min }}-{{ $produk->lebar_max }}cm
                                                                    (Lebar)
                                                                </span>
                                                                <span class="size-badge mb-1">
                                                                    {{ $produk->tinggi_min }}-{{ $produk->tinggi_max }}cm
                                                                    (Tinggi)
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="">
                                                            <span class="text-primary fw-bold"> Harga</span>
                                                            <br>
                                                            <span class="fs-5 fw-bold">
                                                                @if ($produk->min_harga == $produk->max_harga)
                                                                    Rp {{ number_format($produk->min_harga) }}
                                                                @else
                                                                    Rp {{ number_format($produk->min_harga) }} -
                                                                    {{ number_format($produk->max_harga) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <span class="text-dark">Pilihan Kayu:</span>
                                                            <br>
                                                            <small
                                                                class="text-muted">{{ str_replace(',', ', ', $produk->jenis_kayu_list) }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0 ">

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  Shop End-->

    <div class="container-fluid fruite" style="z-index:1">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-6 text-start">
                        <h1>Produk Non-Custom </h1>
                    </div>
                    <div class="col-lg-6 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">

                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" href="{{ url('/exploreProduk') }}"
                                    id="btnLebihBanyak2">
                                    <span class="text-dark" style="width: 200px;">Tampilkan Lebih Banyak</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @for ($i = 0; $i < count($random1); $i++)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <a href="{{ url('/d/' . $random1[$i]->id) }}">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="image-container" style="padding: 5px">
                                                        <img src="{{ asset('storage/imgProduk/' . $random1[$i]->foto_produk1) }}"
                                                            class="img-fluid " alt="">
                                                    </div>
                                                    <div class="p-4 border  border-top-0 rounded-bottom">
                                                        <h4>{{ $random1[$i]->nama_produk }}</h4>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rp
                                                                {{ number_format($random1[$i]->harga_produk, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0 ">

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  Shop End-->



    <div class="modal fade" id="modalBelomLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title">Info </h2>
                    <p>Login Terlebih dahulu untuk akses Produk Custom</p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ url('/login') }}" class="btn btn-dark">Login</a>


                </div>
            </div>
        </div>
    </div>

@endsection
