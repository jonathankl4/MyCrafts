@extends("template.shoppingTemplate")

@section('title', "Produk Detail")

@section('content')

<form action="{{url('donation/pay')}}" method="POST" >
    @csrf
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{asset('storage/imgProduk/'.$produk->foto_produk1)}}" class="img-fluid rounded" alt="Image" style="width: 200px; height: 200px;">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"> {{$produk->nama_produk}}  </h4>
                            <input type="text" style="background: transparent; border: transparent" name="name" value="{{$produk->nama_produk}}" hidden>
                            {{-- <p class="mb-3">Category: Vegetables</p> --}}
                            <h4 class="fw-bold mb-3"> RP {{$produk->harga_produk}} </h4>
                            <h4 class="fw-bold mb-3"><input type="text" hidden style="background: transparent; border: transparent" name="amount" value="{{$produk->harga_produk}}">  </h4>
                            <h4 class="fw-bold mb-3"> <input type="text" hidden style="background: transparent; border: transparent" name="email" value="{{$user->email}}" hidden>  </h4>
                            {{-- <h4 class="fw-bold mb-3"> RP <input type="text" disabled style="background: transparent; border: transparent" value="{{$produk->harga_produk}}">  </h4> --}}

                            {{-- <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div> --}}
                            {{-- <p class="mb-4">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p> --}}
                            {{-- <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish</p> --}}
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" id="pay-button"> beli langsung</button>
                            <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    {{-- <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button> --}}
                                    {{-- <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button> --}}
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{$produk->keterangan_produk}} </p>

                                    {{-- <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Single Product End -->
</form>


@endsection


@section('script')

<script type="text/javascript">
    // $('#pay-button').click(function (event) {
    // event.preventDefault();

    // $.post("{{ route('donation.pay') }}", {
    //     _method: 'POST',
    //     _token: '{{ csrf_token() }}',
    //     name: '{{$produk->nama_produk}}',
    //     email: "email@gmail.com",
    //     amount: 10000,
    //     note: "anjay",
    // }
    // );
    // });
</script>



@endsection
