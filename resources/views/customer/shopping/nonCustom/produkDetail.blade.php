@extends("template.shoppingTemplate")

@section('title', "Produk Detail")

@section('style')

<style>
    .image-container {
height: 250px; /* Sesuaikan dengan tinggi yang diinginkan */
width: 100%; /* Lebar penuh */


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

.shop-container {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .shop-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
    }

    .shop-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .shop-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }
</style>
@endsection

@section('content')

<form action="{{url('/halamanCheckout')}}" method="POST" >
    @csrf
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel" >
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active rounded image-container">
                                        <img src="{{ asset('storage/imgProduk/'.$produk->foto_produk1) }}" class="img-fluid w-100 h-100  rounded"
                                            alt="First slide">

                                    </div>
                                    @for ($i=0;$i<count($foto);$i++)
                                    <div class="carousel-item  rounded image-container">
                                        <img src="{{ asset('storage/imgProduk/'.$foto[$i]) }}" class="img-fluid w-100 h-100 rounded"
                                            alt="First slide">
                                    </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                    data-bs-slide="prev" style="width: 30px;height: 30px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 50%"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                    data-bs-slide="next" style="width: 30px;height: 30px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"  style="width: 50%"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="shop-container">
                                <div class="shop-image">
                                    <img src="{{ asset('storage/foto-toko/'.$toko->foto) }}" alt="{{$toko->nama}} logo">
                                </div>
                                <div class="shop-name">
                                    {{$toko->nama}}
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3"> {{$produk->nama_produk}}  </h4>
                            <input type="text" style="background: transparent; border: transparent" name="name" value="{{$produk->nama_produk}}" hidden>

                            <h4 class="fw-bold mb-3"> RP {{$produk->harga_produk}} </h4>
                            <h4 class="fw-bold mb-3"><input type="text" hidden style="background: transparent; border: transparent" name="amount" value="{{$produk->harga_produk}}">  </h4>
                            <h4 class="fw-bold mb-3"> <input type="text" hidden style="background: transparent; border: transparent" name="email" value="{{$user->email}}" hidden>  </h4>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1" name="jumlah">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="text" name="idProduk" id="idProduk" hidden value="{{$produk->id}}">
                            <button class="btn btn-dark" >Beli</button>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">

                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <h5>Deskripsi</h5>
                                    <p>{{$produk->keterangan_produk}} </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Single Product End -->
</form>
@endsection
@section('script')

@endsection
