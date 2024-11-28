@extends('template.MasterDesain')

@section('title', 'Penerimaan Bahan')

@section('style')
<style>






</style>
@endsection

@section('sidebar')

@include('seller.template.sidebar')

@endsection

@section('navbar')
@include('seller.template.navbar')
@endsection

@section('content')
<div class="container">
    <h1>Data Pengiriman</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('pengiriman.create') }}" class="btn btn-primary">Tambah Pengiriman</a>
        </div>

        <div class="card-body">
            <form action="{{ route('pengiriman.search') }}" method="GET">
                <div class="row">

                    <div class="col-md-2">
                        <input type="date" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary">Cari</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>

                        <th>Mebel</th>
                        <th>Penerima</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengiriman as $item)
                    <tr>
                        <td>{{ $item->id }}</td>


                        <td>{{ $item->mebel->nama_mebel }}</td>
                        <td>{{ $item->nama_penerima }}</td>
                        <td>{{ $item->tanggal_pengiriman }}</td>
                        <td>
                            <a href="{{ route('pengiriman.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $pengiriman->links() }}
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready( function () {
        $('#tPenerimaanBahan').DataTable();
    });




  </script>

@endsection


