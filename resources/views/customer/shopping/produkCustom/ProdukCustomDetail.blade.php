@extends('template.shoppingTemplate')

@section('title', 'Product Detail')

@section('style')
<style>
    .product-gallery {
        position: relative;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 1rem;
        margin-bottom: 2rem;
    }

    /* Shop information styles */
    .shop-info {
        display: flex;
        align-items: center;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #f1f2f6;
    }

    .shop-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 1rem;
        border: 2px solid #f1f2f6;
    }

    .shop-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .shop-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3436;
    }

    .image-container {
        height: 400px;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .image-container img {
        height: 100%;
        width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .carousel-control-prev,
    .carousel-control-next {
        background: rgba(0,0,0,0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.7;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }

    .product-info {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #2d3436;
    }

    .custom-button {
        background: #2d3436;
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }

    .custom-button:hover {
        background: #636e72;
        transform: translateY(-2px);
        color: white;
    }

    .product-details {
        margin-top: 3rem;
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .detail-section {
        margin-bottom: 2rem;
    }

    .detail-section h5 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f2f6;
    }

    .detail-section p {
        color: #636e72;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .price-tag {
        font-weight: 600;
        color: #2d3436;
    }

    .wood-type, .addon-item {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="product-gallery">
                    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active image-container">
                                <img src="{{ asset($foto[0]) }}" class="rounded" alt="Product Image">
                            </div>
                            @if (count($foto) > 1)
                                @for ($i = 1; $i < count($foto); $i++)
                                    <div class="carousel-item image-container">
                                        <img src="{{ asset($foto[$i]) }}" class="rounded" alt="Product Image">
                                    </div>
                                @endfor
                            @endif
                        </div>
                        @if (count($foto) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="product-info">
                    <!-- Added shop information section -->
                    <div class="shop-info">
                        <div class="shop-avatar">
                            <img src="{{ asset('storage/foto-toko/'.$toko->foto) }}" alt="{{$toko->nama}} logo">
                        </div>
                        <div class="shop-name">
                            {{$toko->nama}}
                        </div>
                    </div>
                    <!-- End of shop information section -->

                    <h1 class="product-title">{{ $produk->nama_produk }}</h1>
                    <input type="text" name="idProduk" id="idProduk" hidden value="{{ $produk->id }}">
                    <p class="mb-4">{{ $produk->deskripsi }}</p>
                    <a href="{{ url('/custom/' . $produk->id) }}" class="custom-button">
                        <i class="fas fa-palette me-2"></i>Mulai Kustomisasi
                    </a>
                </div>

                <div class="product-details">
                    <div class="detail-section">
                        <h5><i class="fas fa-ruler-combined me-2"></i>Spesifikasi Ukuran</h5>
                        @if (in_array($produk->kode, ['meja1', 'meja2', 'meja3']))
                            <p>Length: {{ $produk->panjang_min }}cm - {{ $produk->panjang_max }}cm</p>
                            <p>Height: {{ $produk->tinggi_min }}cm - {{ $produk->tinggi_max }}cm</p>
                            <p>Width: {{ $produk->lebar_min }}cm - {{ $produk->lebar_max }}cm</p>
                        @else
                            <p>Width: {{ $produk->lebar_min }}cm - {{ $produk->lebar_max }}cm</p>
                            <p>Height: {{ $produk->tinggi_min }}cm - {{ $produk->tinggi_max }}cm</p>
                            <p>Fixed Depth: {{ $produk->panjang_min }}cm</p>
                        @endif
                    </div>

                    <div class="detail-section">
                        <h5><i class="fas fa-tree me-2"></i>Pilihan Kayu yang tersedia</h5>
                        @foreach($detail as $wood)
                            <div class="wood-type">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $wood->jenis_kayu }}</strong>
                                    <span class="price-tag">Rp. {{ number_format($wood->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="detail-section accordion" id="addonAccordion">
                        <h5><i class="fas fa-plus-circle me-2"></i>Pilihan Add-On yang Tersedia</h5>
                        Klik untuk melihat detail add on masing masing
                        @foreach($addonGabungan as $addon)
                            <div class="addon-item cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapse{{$addon->kode}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $addon->nama_addon }}</strong>
                                    <span class="price-tag">Rp. {{ number_format($addon->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div id="collapse{{$addon->kode}}" class="accordion-collapse collapse" aria-labelledby="headingL" data-bs-parent="#addonAccordion">
                                <div class="accordion-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center">
                                            <img src="{{ asset($addon->url) }}" alt="Sekat Vertical" class="img-fluid shadow-sm" style="max-height: 200px;">
                                        </div>
                                        <div class="col-md-8">
                                            @if ($addon->jenis =='main')
                                            @include('seller.produkCustom.penjelasanAddOn.' . $addon->kode)

                                            @else

                                            @include('seller.produkCustom.penjelasanAddOn.'.$produk->kode.'.' . $addon->kode)
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
