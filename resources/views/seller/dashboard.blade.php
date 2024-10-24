@extends('template.MasterDesain')

@section('title', 'Dashboard')

@section('sidebar')

    @include('seller.template.sidebar')

@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div>
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div>
                            <div class="card-body">
                                <h2 class="card-title text-primary"> Dashboard</h2>

                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">

                                                @if ($toko->status == 'Pro')

                                                <h3 class="card-title mb-2">Membership Berlaku Hingga {{$toko->membership_expires_at}} </h3>
                                                @elseif ($toko->status == 'Free')
                                                <h3 class="card-title mb-2">Membership Free </h3>

                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
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
