@extends('template.shoppingTemplate')

@section('title', 'Custom Products - MyCrafts')

@section('style')
<style>
    .image-container {
        height: 250px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
        overflow: hidden;
    }

    .image-container img {
        height: 100%;
        width: auto;
        object-fit: contain;
        display: block;
        max-width: 100%;
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
<div class="container-fluid py-5">
    <div class="container py-5">
        <br><br><br><br>
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="mb-4">Produk Custom</h1>
            </div>
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ url('/explore-custom-produk') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                           placeholder="Cari produk custom..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-card p-3 mb-4">
            <form action="{{ url('/explore-custom-produk') }}" method="GET" class="row g-3">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <!-- Wood Type Filter -->
                <div class="col-md-3">
                    <label class="form-label">Jenis Kayu</label>
                    <select name="jenis_kayu" class="form-select" onchange="this.form.submit()">
                        <option value="all">Semua Jenis</option>
                        @foreach($woodTypes as $type)
                            <option value="{{ $type }}"
                                {{ request('jenis_kayu') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div class="col-md-3">
                    <label class="form-label">Rentang Harga</label>
                    <select name="price_range" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Harga</option>
                        <option value="0-1000000"
                            {{ request('price_range') == '0-1000000' ? 'selected' : '' }}>
                            < Rp 1.000.000
                        </option>
                        <option value="1000000-2000000"
                            {{ request('price_range') == '1000000-2000000' ? 'selected' : '' }}>
                            Rp 1.000.000 - Rp 2.000.000
                        </option>
                        <option value="2000000-3000000"
                            {{ request('price_range') == '2000000-3000000' ? 'selected' : '' }}>
                            Rp 2.000.000 - Rp 3.000.000
                        </option>
                        <option value="3000000+"
                            {{ request('price_range') == '3000000+' ? 'selected' : '' }}>
                            > Rp 3.000.000
                        </option>
                    </select>
                </div>

                <!-- Size Range Filter -->


                <!-- Sort Filter -->
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih Urutan</option>
                        <option value="price_asc"
                            {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                            Harga: Rendah ke Tinggi
                        </option>
                        <option value="price_desc"
                            {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                            Harga: Tinggi ke Rendah
                        </option>
                        <option value="newest"
                            {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="row g-4">
            @foreach ($listProduk as $produk)
<div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ url('/dc/' . $produk->id) }}">
        <div class="product-item">
            <div class="image-container" style="padding: 5px">
                @if ($produk->kode == 'lemari1')
                    <img src="{{ url('img/lemari1/lemari1.png') }}" class="img-fluid" alt="">
                @elseif ($produk->kode == 'lemari2')
                    <img src="{{ url('img/lemari2/lemari2.png') }}" class="img-fluid" alt="">
                @elseif($produk->kode == 'lemari3')
                    <img src="{{ url('img/lemari3/lemari3.png') }}" class="img-fluid" alt="">
                @elseif($produk->kode == 'meja1')
                    <img src="{{ url('img/meja1/mj.png') }}" class="img-fluid" alt="">
                @elseif($produk->kode == 'meja2')
                    <img src="{{ url('img/meja2/meja2samping.png') }}" class="img-fluid" alt="">
                @endif
            </div>
            <div class="p-4">
                <h4>{{ $produk->nama_produk }}</h4>
                <div class="d-flex mb-3 flex-wrap">
                    @if(str_contains(strtolower($produk->kode), 'lemari'))
                        <span class="size-badge mb-1">
                            {{ $produk->panjang_min }}-{{ $produk->panjang_max }}cm (Kedalaman)
                        </span>
                        <span class="size-badge mb-1">
                            {{ $produk->lebar_min }}-{{ $produk->lebar_max }}cm (Lebar)
                        </span>
                        <span class="size-badge mb-1">
                            {{ $produk->tinggi_min }}-{{ $produk->tinggi_max }}cm (Tinggi)
                        </span>
                    @else
                        <span class="size-badge mb-1">
                            {{ $produk->panjang_min }}-{{ $produk->panjang_max }}cm (Panjang)
                        </span>
                        <span class="size-badge mb-1">
                            {{ $produk->lebar_min }}-{{ $produk->lebar_max }}cm (Lebar)
                        </span>
                        <span class="size-badge mb-1">
                            {{ $produk->tinggi_min }}-{{ $produk->tinggi_max }}cm (Tinggi)
                        </span>
                    @endif
                </div>
                <div class="">
                    <span class="text-primary fw-bold"> Harga</span>
                    <br>
                    <span class="fs-5 fw-bold">
                        @if($produk->min_harga == $produk->max_harga)
                            Rp {{ number_format($produk->min_harga) }}
                        @else
                            Rp {{ number_format($produk->min_harga) }} - {{ number_format($produk->max_harga) }}
                        @endif
                    </span>
                </div>
                <div class="mt-2">
                    <span class="text-dark">Pilihan Kayu:</span>
                    <br>
                    <small class="text-muted">{{ str_replace(',', ', ', $produk->jenis_kayu_list) }}</small>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach

            <!-- Pagination -->
            <div class="col-12 mt-4">
                {{ $listProduk->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
