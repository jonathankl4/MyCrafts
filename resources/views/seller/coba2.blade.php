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

                        <section class="section-products">
                            <div class="container">
                                    <div class="row justify-content-center text-center">
                                            <div class="col-md-8 col-lg-6">
                                                    <div class="header">
                                                            <h3>Featured Product</h3>
                                                            <h2>Popular Products</h2>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-1" class="single-product">
                                                            <div class="part-1">
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-old-price">$79.99</h4>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-2" class="single-product">
                                                            <div class="part-1">
                                                                    <span class="discount">15% off</span>
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-3" class="single-product">
                                                            <div class="part-1">
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-old-price">$79.99</h4>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-4" class="single-product">
                                                            <div class="part-1">
                                                                    <span class="new">new</span>
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-1" class="single-product">
                                                            <div class="part-1">
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-old-price">$79.99</h4>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-2" class="single-product">
                                                            <div class="part-1">
                                                                    <span class="discount">15% off</span>
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-3" class="single-product">
                                                            <div class="part-1">
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-old-price">$79.99</h4>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                            <!-- Single Product -->
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div id="product-4" class="single-product">
                                                            <div class="part-1">
                                                                    <span class="new">new</span>
                                                                    <ul>
                                                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                                                    </ul>
                                                            </div>
                                                            <div class="part-2">
                                                                    <h3 class="product-title">Here Product Title</h3>
                                                                    <h4 class="product-price">$49.99</h4>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </section>

                    </div>
                </div>


            </div>
        </div>
    </div>



</div>
@endsection
