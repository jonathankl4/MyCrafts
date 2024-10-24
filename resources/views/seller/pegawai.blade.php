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
            <h5 class="card-header">List Pegawai</h5>
            <button class="btn btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modalAddPegawai" style="width: fit-content; margin-left: 10px"> Tambah pegawai</button>
            <div class="table-responsive text-nowrap p-3">
                <table id="tsatuan" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>email</th>
                            <th>role</th>
                            <th>aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listPegawai); $i++ )

                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{$listPegawai[$i]->email}}</td>
                            <td>{{$listPegawai[$i]->role}}</td>
                            <td>
                                <a href="" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditPegawai{{$i}}"><i class='bx bxs-pencil'></i></a>
                                <a href="{{url('seller/deletePegawai/'.$listPegawai[$i]->id)}}" class="btn btn-icon btn-danger" ><span class="bx bxs-trash"></span></a>
                            </td>

                        </tr>
                        {{-- modal edit Pegawai --}}
                        <div class="modal fade" id="modalEditPegawai{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Ubah Role </h2>

                                            <form action="{{url('seller/editPegawai/'.$listPegawai[$i]->id)}}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label" >role</label>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="penjualan">Penjualan</option>
                                                        <option value="produksi">Produksi</option>
                                                        <option value="gudang">Gudang</option>

                                                    </select>
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


        {{-- modal tambah Pegawai --}}
        <div class="modal fade" id="modalAddPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title text-primary"> Tambah Pegawai </h2>

                            <form action="{{url('seller/addPegawai')}}" method="POST">
                                @csrf
                                <span>Pastikan User yang ditambah sudah terdaftar dalam website dan tidak pernah mendaftar menjadi seller!</span>
                                <br><br>
                                <div class="mb-3">
                                    <label class="form-label" >email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="cth: shiro@gmail.com" required />
                                    <span style="color: red;">{{ $errors->first('namaSatuan')}}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >role</label>
                                    <select name="role" id="role" class="form-select">
                                        <option value="penjualan">Penjualan</option>
                                        <option value="produksi">Produksi</option>
                                        <option value="gudang">Gudang</option>

                                    </select>
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
