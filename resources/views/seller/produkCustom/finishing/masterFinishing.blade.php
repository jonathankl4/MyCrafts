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
        <h2 class="fw-bold py-3 mb-4">Finishing</h2>


        <div class="card" style="padding: 15px">
            <h5 class="card-header">List Finishing</h5>
            <button class="btn btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modalAddFinishing" style="width: fit-content; margin-left: 10px"> Tambah Finishing</button>
            <div class="table-responsive text-nowrap p-3">
                <table id="tfinishing" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Finishing</th>
                            <th>Tingkat Kilau</th>
                            <th>deskripsi</th>
                            <th>Aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listFinishing); $i++ )

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listFinishing[$i]->nama_finishing}}</b></td>
                            <td style="font-size: 16px"><b>{{$listFinishing[$i]->tingkat_kilau}}</b></td>
                            <td style="font-size: 16px"><b>{{$listFinishing[$i]->deskripsi}}</b></td>
                            <td>
                                <a href="" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditFinishing{{$i}}" ><i class='bx bxs-pencil'></i></a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFinishing{{$i}}"><span class="bx bxs-trash"></span></a>
                            </td>


                        </tr>
                        {{-- modal edit finishing --}}
                        <div class="modal fade" id="modalEditFinishing{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Edit </h2>

                                            <form action="{{url('seller/produkCustom/editFinishing/'.$listFinishing[$i]->id)}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" >Nama Finishing</label>
                                                    <input type="text" class="form-control" id="Editfinishing" name="editNamaFinishing" placeholder="contoh" value="{{$listFinishing[$i]->nama_finishing}}" required />
                                                    <span style="color: red;">{{ $errors->first('editFinishing')}}</span>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" >Tingkat Kilau</label>
                                                    <input type="text" class="form-control" id="Ekilau" name="editTingkatKilau" placeholder="contoh: gloss, satin, matte " required  value="{{$listFinishing[$i]->tingkat_kilau}}"/>
                                                    <span style="color: red;">{{ $errors->first('namaFinishing')}}</span>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" >Deskripsi</label>
                                                    <textarea name="editDeskripsi" id="Edeskripsi" cols="30" rows="5" class="form-control" required>{{$listFinishing[$i]->deskripsi}}</textarea>
                                                    <span style="color: red;">{{ $errors->first('namaFinishing')}}</span>
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

                        <div class="modal fade" id="modalDeleteFinishing{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="card-title text-primary"> Delete Finishing {{$listFinishing[$i]->nama_finishing}} </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/produkCustom/deleteFinishing/'.$listFinishing[$i]->id)}}">

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


        {{-- modal tambah finishing --}}
        <div class="modal fade" id="modalAddFinishing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="card-title text-primary"> Tambah Finishing </h2>

                            <form action="{{url('seller/produkCustom/addFinishing')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" >Nama Finishing</label>
                                    <input type="text" class="form-control" id="finishing" name="namaFinishing" placeholder="contoh: gloss clear coat" required />
                                    <span style="color: red;">{{ $errors->first('namaFinishing')}}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >Tingkat Kilau</label>
                                    <input type="text" class="form-control" id="kilau" name="tingkatKilau" placeholder="contoh: gloss, satin, matte " required />
                                    <span style="color: red;">{{ $errors->first('namaFinishing')}}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" required></textarea>
                                    <span style="color: red;">{{ $errors->first('namaFinishing')}}</span>
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
        $('#tfinishing').DataTable();






    });




  </script>
@endsection
