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

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 1cm ">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Riwayat Permintaan Pembelian</h3>
                        <a href="{{url('/seller/gudang/formPermintaanPembelian') }}" class="btn btn-primary">
                            + Buat Permintaan Baru
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
                                    <th>Status</th>
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
                                        <td>
                                            <span class="badge {{ match($permintaan->status) {
                                                0 => 'bg-warning',
                                                1 => 'bg-success',
                                                2 => 'bg-danger',
                                                default => 'bg-secondary'
                                            } }}">
                                                {{ $permintaan->status_text }}
                                            </span>
                                        </td>
                                        <td>{{ $permintaan->detailPermintaanPembelian->count() }} item</td>
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
                                        <td colspan="6" class="text-center">Tidak ada data permintaan pembelian</td>
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
                    <strong>Status:</strong> {{ $permintaan->status_text }}
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
                            @foreach($permintaan->detailPermintaanPembelian as $index => $detail)
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
                @if($permintaan->status == 0)
                    {{-- <form action="{{ route('permintaan-pembelian.destroy', $permintaan->id) }}" --}}
                    <form action=""
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus permintaan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                @endif
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


