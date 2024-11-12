@extends('template.MasterDesain')

@section('title', 'Dashboard')

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
<div class="content-wrapper">
    <!-- Content -->

    <div class="flex-grow-1 container-p-y" style="width: 100% ; ">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Riwayat Pencatatan Pembelian</h3>
                        <a href="{{url('/seller/formPermintaanPembelian') }}" class="btn btn-primary">
                            + Buat Pencatatan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tsatuan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Jumlah Item</th>
                                    <th>Total Pembelian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permintaans as $index => $permintaan)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $permintaan->tanggal }}</td>

                                        <td>{{ $permintaan->detailPencatatanPembelian->count() }} item</td>
                                        <td>Rp {{ number_format($permintaan->total_pembelian, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $permintaan->id }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data pembelian</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

        @foreach($permintaans as $permintaan)
<div class="modal fade" id="detailModal{{ $permintaan->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Permintaan Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Tanggal:</strong> {{ $permintaan->tanggal }}<br>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permintaan->detailPencatatanPembelian as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>{{ $detail->satuan }}</td>
                                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Total Pembelian:</strong></td>
                                <td><strong>Rp {{ number_format($permintaan->total_pembelian, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                    {{-- <form action="{{ route('permintaan-pembelian.destroy', $permintaan->id) }}" --}}
                    <form action="{{url('/seller/pencatatanPembelian/hapus/'. $permintaan->id)}}"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus permintaan ini?')">
                        @csrf

                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>

            </div>
        </div>
    </div>
</div>
@endforeach








    </div>




















    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
  </div>


@endsection


@section('script')
<script>
    $(document).ready( function () {
        $('#tsatuan').DataTable();
    });




  </script>

@endsection


