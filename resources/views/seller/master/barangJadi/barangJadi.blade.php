@extends('template.MasterDesain')

@section('title', 'Dashboard')

@section('style')
<style>
    .dataTables_wrapper .dataTables_filter {
  position: absolute;
  top: 130px;
  right: 40px;


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
    <!-- Content -->

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
        <h2 class="fw-bold py-3 mb-4">Mebel</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header">List Mebel</h5>

            <a href="{{url('/seller/pAddMebel')}}">
                <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah Mebel</button>
            </a>

            <div class="table-responsive text-nowrap p-3">
                <table id="tMebel" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mebel</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Jenis Mebel</th>
                            <th>Harga Mebel</th>
                            <th>foto Utama</th>
                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listMebel); $i++ )
                        @php
                            $p =$listMebel[$i]->ukuran_panjangMebel;
                            $l =$listMebel[$i]->ukuran_lebarMebel;
                            $t =$listMebel[$i]->ukuran_tinggiMebel;
                            $satuan = $listMebel[$i]->satuanUkuran_mebel;
                        @endphp

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listMebel[$i]->nama_mebel}}</b></td>
                            <td style="font-size: 16px"><b>{{$p}}x{{$l}}x{{$t}} {{$satuan}}</b></td>
                            <td style="font-size: 16px"><b>{{$listMebel[$i]->jumlah_mebel}}</b></td>
                            <td style="font-size: 16px"><b>{{$listMebel[$i]->tipe_mebel}}</b></td>
                            <td style="font-size: 16px"><b>{{$listMebel[$i]->harga_mebel}}</b></td>
                            <td>
                                <a href=""  data-bs-toggle="modal" data-bs-target="#modalImage{{$i}}"><img src="{{url("/storage/imgMebel/".$listMebel[$i]->foto_mebel1)}}" alt="" style="width:100px; height:100px" ></a>
                            </td>

                            <td>
                                <a href="{{url('/seller/pEditMebel/'.$listMebel[$i]->id)}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$i}}"><span class="bx bxs-trash"></span></a>
                            </td>
                            {{-- <td>

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
                                                    <h3 class="product-title">{{$listMebel[$i]->nama_mebel}}</h3>
                                                    <h4 class="product-price">{{$listMebel[$i]->harga_mebel}}</h4>
                                            </div>
                                    </div>
                            </div>
                            </td> --}}

                        </tr>
                        {{-- modal delete Mebel --}}
                        <div class="modal fade" id="modalDelete{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Delete Mebel {{$listMebel[$i]->nama_mebel}} </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/deleteMebel/'.$listMebel[$i]->id)}}">

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
                                    <img class="modal-content" src="{{url("/storage/imgMebel/".$listMebel[$i]->foto_mebel1)}}"  >


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
<script>
    $(document).ready( function () {
        $('#tMebel').DataTable();






    });




  </script>
@endsection
