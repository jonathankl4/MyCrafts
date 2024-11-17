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
        <h2 class="fw-bold py-3 mb-4">Finishing {{$produk->nama_template}}</h2>

        <a href="{{url('/seller/produkCustom/daftarProdukCustom')}}" class="btn btn-dark"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
        <div class="card" style="padding: 15px">
            <h5 class="card-header">List Finishing</h5>
            <button class="btn btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modalAddFinishing" style="width: fit-content; margin-left: 10px"> Tambah Finishing</button>
            <div class="table-responsive text-nowrap p-3">
                <table id="tfinishing" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Finishing</th>
                            <th>Harga</th>
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
                            <td style="font-size: 16px"><b>Rp {{number_format($listFinishing[$i]->harga, 0, ',', '.')}}</b></td>
                            <td style="font-size: 16px"><b>{{$listFinishing[$i]->tingkat_kilau}}</b></td>
                            <td style="font-size: 16px"><b>{{$listFinishing[$i]->deskripsi}}</b></td>
                            <td>
                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditFinishing{{$i}}" >Ubah Harga</a>
                                <a href="" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFinishingDijual{{$i}}"><span class="bx bxs-trash"></span></a>
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
                                    <h2 class="card-title text-primary"> Ubah Harga </h2>

                                            <form action="{{url('seller/produkCustom/editFinishingDijual/'.$listFinishing[$i]->fdId)}}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label" >Harga</label>
                                                    <input type="number" class="form-control" id="kilau" name="editHarga" placeholder="" value="{{$listFinishing[$i]->harga}}" required />
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

                        <div class="modal fade" id="modalDeleteFinishingDijual{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <a href="{{url('seller/produkCustom/deleteFinishingDijual/'.$listFinishing[$i]->fdId)}}">

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

                            <form action="{{url('seller/produkCustom/addFinishingDijual/'.$produk->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" >Pilih Finishing</label>
                                    <select name="finishingId" id="" class="form-select">
                                        @for ($i= 0; $i < count($masterFinishing); $i++)

                                        <option value="{{$masterFinishing[$i]->id}}">{{$masterFinishing[$i]->nama_finishing}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >Harga</label>
                                    <input type="number" class="form-control" id="kilau" name="harga" placeholder="" required />
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
