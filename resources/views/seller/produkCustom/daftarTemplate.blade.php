@extends('template.MasterDesain')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

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

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
        <h2 class="fw-bold py-3 mb-4">Template Mebel</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header">Daftar Template</h5>


            <a href="{{url('/seller/produk/tambahTemplate')}}">
                <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah Template Mebel</button>
            </a>

            <div class="table-responsive text-nowrap p-3">
                <table id="tProduk" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Info Produk</th>
                            <th>Stok</th>
                            <th>Harga Produk</th>
                            <th>Status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listTemplate); $i++ )



                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px">
                                <div style="float: left">
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#modalImage{{$i}}"><img src="{{url("/storage/imgProduk/".$listTemplate[$i]->foto_produk1)}}" alt="" style="width:70px; height:70px" ></a>
                                        <b>{{$listTemplate[$i]->nama_produk}}</b>
                                </div>
                            </td>

                            <td style="font-size: 16px"><b>{{$listTemplate[$i]->jumlah_produk}}</b></td>

                            <td style="font-size: 16px"><b>Rp {{$listTemplate[$i]->harga_produk}}</b></td>
                            <td style="font-size: 16px">
                                @if ($listTemplate[$i]->status == "nonaktif")
                                <div class="col-3 text-end">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input float-end" id="statuscek{{$listTemplate[$i]->id}}" type="checkbox" role="switch"  onchange="statuschange({{$listTemplate[$i]->id}})"/>
                                    </div>
                                  </div>
                                  @else
                                  <div class="col-3 text-end">
                                      <div class="form-check form-switch">
                                        <input class="form-check-input float-end" id="statuscek{{$listTemplate[$i]->id}}" type="checkbox" role="switch"  checked onchange="statuschange({{$listTemplate[$i]->id}})"/>
                                      </div>
                                    </div>
                                    @endif


                            </td>

                            <td>
                                <a href="{{url('/seller/pEditProduk/'.$listTemplate[$i]->id)}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$i}}"><span class="bx bxs-trash"></span></a>

                            </td>


                        </tr>
                        {{-- modal delete Produk --}}
                        <div class="modal fade" id="modalDelete{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Delete Produk {{$listTemplate[$i]->nama_produk}} </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/deleteProduk/'.$listTemplate[$i]->id)}}">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                    </a>

                                </div>
                              </div>
                            </div>
                        </div>

                        <div id="modalImage{{$i}}" class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%; height: 100%;">




                            <div class="modal-dialog">
                                <div class="modal-content" style="margin: auto;display: block;width: 80%;max-width: 700px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="modal-content" src="{{url("/storage/imgProduk/".$listTemplate[$i]->foto_produk1)}}"  >


                                </div>

                              </div>
                            </div>
                          </div>


                        @endfor









                    </tbody>

                </table>

            </div>
        </div>






    </div>



    <div class="modal fade" id="modalDeleteSup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="card-title text-primary">  </h2>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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


@section('script')



@endsection
