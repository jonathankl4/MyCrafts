@extends("template.MasterDesain")

@section('title', "dashboard")

@section('sidebar')

@include('seller.template.sidebarcoba')
@endsection

@section('navbar')
@include('customer.template.navbar')
@endsection

@section('content')
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
@endsection
