@extends('template.shoppingTemplate')

@section('title', 'MyCrafts')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

.card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-select, .form-control {
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .form-select:focus, .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

@endsection


@section('content')
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <br><br><br><br>
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="mb-4">Produk Non-Custom</h1>
            </div>
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ url('/exploreProduk') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                           placeholder="Cari produk..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/exploreProduk') }}" method="GET" class="row g-3">
                            <!-- Preserve search query if exists -->
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif

                            <!-- Product Type Filter -->
                            <div class="col-md-3">
                                <label class="form-label">Toko</label>
                                <select name="id_toko" class="form-select select2" onchange="this.form.submit()">
                                    <option value="all">Semua Toko</option>
                                    @foreach($toko as $t)
                                        <option value="{{ $t->id }}"
                                            {{ request('id_toko') == $t->id ? 'selected' : '' }}>
                                            {{ $t->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="col-md-3">
                                <label class="form-label">Rentang Harga</label>
                                <select name="price_range" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Harga</option>
                                    <option value="0-100000"
                                        {{ request('price_range') == '0-100000' ? 'selected' : '' }}>
                                        Rp 0 - Rp 100.000
                                    </option>
                                    <option value="100000-500000"
                                        {{ request('price_range') == '100000-500000' ? 'selected' : '' }}>
                                        Rp 100.000 - Rp 500.000
                                    </option>
                                    <option value="500000-1000000"
                                        {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>
                                        Rp 500.000 - Rp 1.000.000
                                    </option>
                                    <option value="1000000+"
                                        {{ request('price_range') == '1000000+' ? 'selected' : '' }}>
                                        > Rp 1.000.000
                                    </option>
                                </select>
                            </div>

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

                            <!-- Reset Filter -->
                            <div class="col-md-3 d-flex align-items-end">
                                <a href="{{ url('/exploreProduk') }}"
                                   class="btn btn-secondary">Reset Filter</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Existing Product Grid -->
        <div class="row g-4">
            <!-- Your existing product grid code here -->
            <!-- ... -->
            <div class="col-lg-12">

                <div class="row g-4">

                    <div class="col-lg-12">
                        <div class="row g-4 ">
                            @foreach ($listProduk as $produk)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <a href="{{ url('/d/' . $produk->id) }}">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="image-container" style="padding: 5px">
                                            <img src="{{ asset('storage/imgProduk/' . $produk->foto_produk1) }}"
                                                class="img-fluid " alt="">
                                        </div>
                                        <div class="p-4 border border-top-0 rounded-bottom">
                                            <h4>{{ $produk->nama_produk }}</h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">Rp
                                                    {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach


                            <div class="col-12">
                                <div class=" ">
                                    <!-- Menampilkan link pagination -->
                                    {{ $listProduk->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
 $(document).ready( function () {

        $('.select2').select2();
    });
</script>

@endsection

