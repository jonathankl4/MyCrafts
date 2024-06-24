@extends("template.MasterDesain")

@section('title', "dashboard")

@section('sidebar')

@include('customer.template.sidebar')

@endsection

@section('navbar')
@include('customer.template.navbar')
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
                            <h2 class="card-title text-primary"> Dashboard customer {{$user->username}} </h2>

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
