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
        <h1 class="mb-4">Produk</h1>
        <div class="row g-4">
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
                                                    {{ $produk->harga_produk }}</p>
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

