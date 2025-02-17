@extends('template.MasterDesain')

@section('title', 'Detail BOM')

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
            <h5 class="card-header">Detail BOM</h5>
            <h5 class="card-header">Nama Produk : {{$bom->nama_product}} </h5>


            <div>
                <a href="{{url('/seller/pAddDetailBom/'.$bom->id)}}">
                    <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Tambah Detail</button>
                </a>
                <a href="{{url('/seller/produksi/bom')}}">
                    <button class="btn btn-primary" id="add"  style="width: fit-content; margin-left: 10px"> Kembali</button>
                </a>
            </div>


            <div class="table-responsive text-nowrap p-3">
                <table id="tMebel" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama bahan</th>
                            <th>deskripsi</th>
                            <th>jumlah</th>
                            <th>ukuran</th>
                            <th>harga</th>
                            <th>subtotal</th>

                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listDetail); $i++ )

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listDetail[$i]->nama_bahan}}</b></td>
                            <td style="font-size: 16px"><b>{{$listDetail[$i]->keterangan}}</b></td>
                            <td style="font-size: 16px"><b>{{$listDetail[$i]->jumlah}}</b></td>
                            <td style="font-size: 16px"><b> <p>{{$listDetail[$i]->ukuran_bahan}}</p></b></td>
                            <td style="font-size: 16px"><b>{{$listDetail[$i]->harga_bahan}}</b></td>
                            <td style="font-size: 16px"><b>{{$listDetail[$i]->subtotal}}</b></td>



                            <td>
                                <a href="{{url('/seller/pEditDetailBom/'.$listDetail[$i]->id)}}" class="btn btn-icon btn-warning"><i class='bx bxs-pencil'></i></a>
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
                                    <h2 class="card-title text-primary"> Yakin Delete {{$listDetail[$i]->nama_bahan}} ?</h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/deleteDetailBom/'.$listDetail[$i]->id)}}">

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
        $('#tMebel').DataTable();






    });




  </script>
@endsection
