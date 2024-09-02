@extends('template.MasterDesain')

@section('title', 'Perencanaan Produksi')

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
        <h2 class="fw-bold py-3 mb-4">Produksi</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header">Daftar Produksi</h5>

            <a href="{{url('/seller/pAddProduksi')}}">
                <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah Produksi</button>
            </a>

            {{-- ini jika mau table nya responsive --}}
            {{-- <div class="table-responsive text-nowrap p-3"> --}}
            <div class="">
                <table id="tMebel" class="table table-striped" >
                    <thead>
                        <tr>
                            {{-- <th>No</th> --}}
                            <th>Kode Produksi</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Produksi</th>
                            <th>tanggal Produksi</th>
                            <th>Status</th>
                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listProduksi); $i++ )

                        <tr>
                            {{-- <td>{{$i+1}}</td> --}}
                            <td style="font-size: 16px"><b>{{$listProduksi[$i]->kode_produksi}}</b></td>
                            <td style="font-size: 16px"><b>{{$listProduksi[$i]->nama_produk}}</b></td>
                            <td style="font-size: 16px"><b>{{$listProduksi[$i]->jumlahdiproduksi}}</b></td>
                            <td style="font-size: 16px"><b>{{$listProduksi[$i]->tgl_produksi_mulai}}</b></td>
                            @php
                                $s = $listProduksi[$i]->status;
                                $status = "";
                                $color = "";
                                if($s == 0){
                                    $status = "Belum Dimulai";
                                    $color = "bg-info";
                                }
                                else if($s == 1){
                                    $status = "Dalam proses";
                                    $color = "bg-warning";
                                }
                                else if($s == 3){
                                    $status = "DiBatalkan";
                                    $color = "bg-danger";
                                }
                                else {
                                    $status = "Selesai";
                                    $color = "bg-success";
                                }
                            @endphp
                            <td style="font-size: 16px"><b><span class="badge {{$color}}">{{$status}}</span></b></td>

                            <td>


                                <a href="{{url('/seller/pEditProduksi/'.$listProduksi[$i]->id)}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$i}}">Batalkan</a>
                                @if ($s == 1)
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSelesai{{$i}}">Selesai</a>
                                @endif
                            </td>


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
                                    <h2 class="card-title text-primary"> Yakin batalkan produksi {{$listProduksi[$i]->nama_produk}} ? </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/batalkanProduksi/'.$listProduksi[$i]->id)}}">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Yakin</button>
                                    </a>

                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalSelesai{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Yakin Selesaikan produksi {{$listProduksi[$i]->nama_produk}} ? </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/selesaikanProduksi/'.$listProduksi[$i]->id)}}">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Yakin</button>
                                    </a>

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
