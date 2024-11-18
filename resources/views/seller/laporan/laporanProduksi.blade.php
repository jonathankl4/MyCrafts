@extends('template.LaporanTemplate')

@section('title', 'Laporan Produksi')

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
    <div class="container-fluid px-4 py-3">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header fw-bold py-3">
                    <i class="fas fa-chart-line me-2"></i>Laporan Produksi
                </h2>

                <!-- Summary Cards -->


                <!-- Filter Section -->

                <!-- Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-fluid text-center py-3">
            <small class="text-muted">© 2024 MyCrafts</small>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('script')
<script>


</script>
@endsection
