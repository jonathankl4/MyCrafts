@extends('template.MasterDesain')

@section('title', 'Pengaturan Toko')

@section('sidebar')
    @include('seller.template.sidebar')
@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div>
                        <div class="card-body">
                            <h2 class="card-title text-dark">Pengaturan Toko</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{route('seller.toko.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $toko->nama }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slogan" class="form-label">Slogan</label>
                                <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $toko->slogan }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $toko->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Toko</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                            @if ($toko->foto)
                                <img src="{{ asset('storage/foto-toko/' . $toko->foto) }}" alt="Foto Toko" class="img-thumbnail mt-2" width="200">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
        <footer class="content-footer footer bg-footer-theme">
        </footer>
        <div class="content-backdrop fade"></div>
    </div>
@endsection
