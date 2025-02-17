@extends('template.MasterDesain')

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
        <h2 class="fw-bold py-3 mb-4">Supplier</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header">List Supplier</h5>

            <a href="{{url('/seller/pAddSupplier')}}">
                <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah Supplier</button>
            </a>

            <div class="table-responsive text-nowrap p-3">
                <table id="tSupplier" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>keterangan</th>
                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listSupplier); $i++ )

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listSupplier[$i]->nama_sup}}</b></td>
                            <td style="font-size: 16px"><b>{{$listSupplier[$i]->notelp_sup}}</b></td>
                            <td style="font-size: 16px"><b>{{$listSupplier[$i]->alamat_sup}}</b></td>
                            <td style="font-size: 16px"><b>{{$listSupplier[$i]->keterangan_sup}}</b></td>

                            <td>
                                <a href="{{url('/seller/pEditSupplier/'.$listSupplier[$i]->id)}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteSup{{$i}}"><span class="bx bxs-trash"></span></a>
                            </td>

                        </tr>
                        {{-- modal delete supplier --}}
                        <div class="modal fade" id="modalDeleteSup{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Delete Supplier {{$listSupplier[$i]->nama_sup}} </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/deleteSupplier/'.$listSupplier[$i]->id)}}">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
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
        $('#tSupplier').DataTable();






    });




  </script>
@endsection
