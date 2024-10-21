@extends('template.shoppingTemplate')

@section('title', 'Produk Detail')

@section('style')

    <style>
        .image-container {
            height: 100%;
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

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .value {
            color: #555;
        }

        .total .value {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
@endsection

@section('content')
    <br><br><br>
    <!-- Checkout Page Start -->
    <form action="/checkOutNonCustom" method="post">
        @csrf

        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Detail Pembelian</h1>
                <form action="#">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-6" style="color: black">

                            <div class="form-item">
                                <label class="form-label my-3">Alamat Pengiriman <sup>*</sup></label>
                                <input type="text" name="alamat" class="form-control" placeholder="House Number Street Name" required>
                            </div>


                            <div class="form-item">
                                <label class="form-label my-3">Nomor Telepon<sup>*</sup></label>
                                <input type="text" class="form-control" name="nomorTelp" required>
                            </div>


                            <br>
                            <div class="form-item">
                                <textarea name="catatan" class="form-control" spellcheck="false" cols="30" rows="11"
                                    placeholder="Catatan (Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="product-details">
                                <div class="detail-item">
                                    <span class="label">Nama Produk:</span>
                                    <span class="value">{{ $produk->nama_produk }} </span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Harga:</span>
                                    <span class="value">Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Quantity:</span>
                                    <span class="value">{{ $jumlah }}</span>
                                </div>
                                <div class="detail-item total">
                                    <span class="label">Total:</span>
                                    <span class="value">Rp.
                                        {{ number_format($produk->harga_produk * $jumlah, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <input type="text" name="jumlah" value="{{$jumlah}}" hidden>
                            <input type="text" name="idProduk" value="{{$produk->id}}" hidden>


                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button
                                    class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- Checkout Page End -->


@endsection


@section('script')





@endsection
