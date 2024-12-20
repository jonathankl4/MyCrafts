@extends('template.MasterDesain')

@section('title', 'Bill Of Material')

@section('style')
<style>
    .dataTables_wrapper .dataTables_filter {
  /* position: absolute;
  top: 130px;
  right: 40px; */


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
        <h2 class="fw-bold py-3 mb-4">Bill Of Material</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header">List BOM</h5>

            <a href="" data-bs-toggle="modal" data-bs-target="#modalTambahBom">
                <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah BOM Baru</button>
            </a>

            <div class="table-responsive text-nowrap p-3">
                <table id="tMebel" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Perkiraan Harga Produksi</th>
                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listBom); $i++ )

                        @php
                            $total = $listBom[$i]->total_biaya;





                        @endphp

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listBom[$i]->nama_product}}</b></td>
                            <td style="font-size: 16px"><b>{{$total}}</b></td>



                            <td>

                                <a href="{{url('/seller/pDetailBom/'.$listBom[$i]->id)}}" class="btn btn-warning">Detail</a>
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditBom{{$i}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$i}}"><span class="bx bxs-trash"></span></a>
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
                                    <h2 class="card-title text-primary"> Delete BOM {{$listBom[$i]->nama_product}} </h2>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/deleteBom/'.$listBom[$i]->id)}}">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                    </a>

                                </div>
                              </div>
                            </div>
                        </div>
                        {{-- modal edit bom  --}}
                        <div class="modal fade" id="modalEditBom{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary">Edit Bom </h2>
                                    <form action="{{url('seller/editBom/'.$listBom[$i]->id)}}" method="POST">
                                        @csrf
                                        <div class="mb-3 row">
                                            <label class=" col-form-label" style="font-size: 16px">Nama Produk</label>
                                            <div class="col-md-10">

                                                <input type="text" class="form-control" id="namaProdukEdit" name="namaProdukEdit" placeholder="-" required value="{{$listBom[$i]->nama_product}}" />
                                                <span style="color: red;">{{ $errors->first('namaProdukEdit')}}</span>
                                            </div>
                                        </div>


                                        <div style="float: right">

                                            <button class="btn btn-primary">Simpan</button>
                                        </div>

                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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



    <div class="modal fade" id="modalTambahBom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="card-title text-primary">Tambah Bom  </h2>
                <form action="{{url('seller/addBom')}}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="-" required />
                            <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                        </div>
                    </div>

                    <div style="float: right">

                        <button class="btn btn-primary">Tambah</button>
                    </div>

                </form>




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
