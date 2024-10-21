@extends('template.shoppingTemplate')

@section('title', 'Produk Detail')

@section('style')

    <style>
        .image-container {
            height: 250px;
            /* Sesuaikan dengan tinggi yang diinginkan */
            width: 100%;
            /* Lebar penuh */


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
    </style>
@endsection

@section('content')


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active rounded image-container">
                                        <img src="{{ asset($foto[0]) }}" class="img-fluid w-100 h-100  rounded"
                                            alt="First slide">
                                        {{-- <a href="#" class="btn px-4 py-2 text-white rounded">Lemari</a> --}}
                                    </div>
                                    @if (count($foto) > 1)
                                        @for ($i = 1; $i < count($foto); $i++)
                                            <div class="carousel-item  rounded image-container">
                                                <img src="{{ asset($foto[$i]) }}" class="img-fluid w-100 h-100 rounded"
                                                    alt="First slide">

                                            </div>
                                        @endfor
                                    @endif



                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                    data-bs-slide="prev" style="width: 30px;height: 30px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 50%"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                    data-bs-slide="next" style="width: 30px;height: 30px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true" style="width: 50%"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"> {{ $produk->nama_produk }} </h4>
                            <input type="text" style="background: transparent; border: transparent" name="name"
                                value="{{ $produk->nama_produk }}" hidden>
                            {{-- <p class="mb-3">Category: Vegetables</p> --}}
                            {{-- <h4 class="fw-bold mb-3"> harga </h4> --}}
                            <h4 class="fw-bold mb-3"><input type="text" hidden
                                    style="background: transparent; border: transparent" name="amount"
                                    value="{{ $produk->harga_produk }}"> </h4>
                            <h4 class="fw-bold mb-3"> <input type="text" hidden
                                    style="background: transparent; border: transparent" name="email"
                                    value="{{ $user->email }}" hidden> </h4>
                            {{-- <h4 class="fw-bold mb-3"> RP <input type="text" disabled style="background: transparent; border: transparent" value="{{$produk->harga_produk}}">  </h4> --}}

                            {{-- <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div> --}}
                            {{-- <p class="mb-4">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p> --}}
                            {{-- <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish</p> --}}

                            <input type="text" name="idProduk" id="idProduk" hidden value="{{ $produk->id }}">
                            <a href="{{ url('/custom/' . $produk->id) }}" class="btn btn-dark">Mulai Custom </a>
                            {{-- <button class="btn btn-dark">Mulai Custom</button> --}}
                            {{-- <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-dark" id="pay-button">Beli</button> --}}
                            {{-- <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> --}}
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    {{-- <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button> --}}
                                    {{-- <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button> --}}
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab"
                                    style="color: black">
                                    <h5>Deskripsi</h5>
                                    <p>{{ $produk->deskripsi }} </p>
                                    <div>
                                        <h5>Keterangan Ukuran</h5>
                                        <p>Panjang: {{ $produk->panjang_min }}cm s/d {{ $produk->panjang_max }}cm </p>
                                        <p>Tinggi: {{ $produk->tinggi_min }}cm s/d {{ $produk->tinggi_max }}cm </p>
                                        <p>Lebar: Paten {{ $produk->lebar_min }}cm </p>
                                    </div>
                                    <div>
                                        <h5>Pilihan Jenis Kayu</h5>
                                        @for ($i = 0; $i < count($detail); $i++)
                                            <p>- <b>{{ $detail[$i]->jenis_kayu }}</b> dengan start harga Rp.
                                                {{ number_format($detail[$i]->harga, 0, ',', '.') }} </p>
                                        @endfor
                                    </div>
                                    <div>
                                        <h5>List Add On Customisasi</h5>
                                        @for ($i = 0; $i < count($addonMain); $i++)
                                            <p>- <b>{{ $addonMain[$i]->nama_addon }}</b> dengan start harga Rp.
                                                {{ number_format($addonMain[$i]->harga, 0, ',', '.') }} </p>
                                        @endfor
                                    </div>
                                    <div>
                                        {{-- <h5>Pilihan Pintu</h5> --}}
                                    </div>
                                    {{-- <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Single Product End -->



@endsection


@section('script')





@endsection
