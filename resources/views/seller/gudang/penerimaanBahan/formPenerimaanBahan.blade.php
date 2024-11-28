@extends('template.MasterDesain')

@section('title', 'Form Penerimaan Bahan')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        width: 100% !important;
    }
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Penerimaan Bahan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('penerimaan-barang.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Penerimaan</label>
                            <input type="datetime-local" class="form-control" name="tanggal_penerimaan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier</label>
                            <select name="id_supplier" class="form-control select2" required>
                                <option value="">Pilih Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_sup }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Detail Bahan</h6>
                            <button type="button" id="addBarangBtn" class="btn btn-primary btn-sm">
                                Tambah Bahan
                            </button>
                        </div>
                        <div class="card-body" id="barangContainer">
                            <!-- Dynamic rows will be added here -->
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan Penerimaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();

    let barangIndex = 0;
    $('#addBarangBtn').click(function() {
        const barangHtml = `
            <div class="row mb-3 barang-row">
                <div class="col-md-5">
                    <select name="barangs[${barangIndex}][id]" class="form-control select2" required>
                        <option value="">Pilih Bahan</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_bahan }} (per {{$barang->satuan_jumlah}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="barangs[${barangIndex}][jumlah]"
                           class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="barangs[${barangIndex}][keterangan]"
                           class="form-control" placeholder="Keterangan (opsional)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-barang">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
        `;
        $('#barangContainer').append(barangHtml);
        $('.select2').select2();
        barangIndex++;
    });

    $(document).on('click', '.remove-barang', function() {
        $(this).closest('.barang-row').remove();
    });
});
</script>
@endsection
