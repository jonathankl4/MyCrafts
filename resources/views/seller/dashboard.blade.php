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
                    <div >
                        <div class="card-body" >
                            <h2 class="card-title text-primary"> Dashboard seller {{$user->username}} </h2>

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
