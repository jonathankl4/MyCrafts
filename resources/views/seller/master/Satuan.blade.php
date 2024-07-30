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
        <h2 class="fw-bold py-3 mb-4">Satuan</h2>


        <div class="card" style="padding: 15px">
            <h5 class="card-header">List Satuan</h5>
            <button class="btn btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modalAddSatuan" style="width: fit-content; margin-left: 10px"> Tambah Satuan</button>
            <div class="table-responsive text-nowrap p-3">
                <table id="tsatuan" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listSatuan); $i++ )

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listSatuan[$i]->nama_satuan}}</b></td>
                            <td>
                                <a href="" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditSatuan{{$i}}" ><i class='bx bxs-pencil'></i></a>
                                <a href="{{url('seller/deleteSatuan/'.$listSatuan[$i]->id)}}" class="btn btn-icon btn-danger"><span class="bx bxs-trash"></span></a>
                            </td>


                        </tr>
                        {{-- modal edit satuan --}}
                        <div class="modal fade" id="modalEditSatuan{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Edit </h2>

                                            <form action="{{url('seller/editSatuan/'.$listSatuan[$i]->id)}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" >Nama Satuan</label>
                                                    <input type="text" class="form-control" id="satuan" name="editSatuan" placeholder="contoh: gram, kg, dll" value="{{$listSatuan[$i]->nama_satuan}}" />
                                                    <span style="color: red;">{{ $errors->first('editSatuan')}}</span>
                                                </div>

                                                <button class="btn btn-primary">Simpan</button>


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


        {{-- modal tambah satuan --}}
        <div class="modal fade" id="modalAddSatuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title text-primary"> Tambah Satuan </h2>

                            <form action="{{url('seller/addSatuan')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" >Nama Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="namaSatuan" placeholder="contoh: gram, kg, dll" />
                                    <span style="color: red;">{{ $errors->first('namaSatuan')}}</span>
                                </div>

                                <button class="btn btn-primary">Tambah</button>


                            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
        </div>



    </div>


    @php
        $cektambah = $errors->first('namaSatuan');
        $cekedit = $errors->first('editSatuan')
    @endphp
    @if($cektambah != null)
    <script>


        $(document).ready( function () {
            $("#add").trigger('click');







    });
    </script>



    @endif


















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
        $('#tsatuan').DataTable();






    });




  </script>
@endsection
