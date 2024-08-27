@extends('template.BackupMasterDesain')

@section('title', 'Tambah Produk Custom')

@section('style')
<style>






#image-label{
    position: relative;
    width: 200px;
    height: 200px;
    background: #fff;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    display:flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 1px 7px rgba(105, 110, 232, 0.54);
    border-radius: 10px;
    flex-direction: column;
    gap: 15px;
    user-select: none;
    cursor: pointer;
    color: #207ed1;
    transition: all 1s;
}

#image-label:hover{
    color: #18ac1c;
}







</style>
@endsection

@section('sidebar')



@endsection

@section('navbar')
@include('seller.template.navbar')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 1cm ">
        <h2 class="fw-bold  mb-4">Tambah Produk Custom</h2>
        <form action="{{url('seller/addProdukCustom')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Informasi Produk</h3>

                    <div class="mb-3 row ">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk"  value="{{old('namaProduk')}}"/>
                            <span style="color: red; font-size: 12px">*tambahkan kata custom pada nama paling belakang</span>
                            <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px" >tipe Produk</label>
                        <div class="col-md-10">
                        <input type="text" class="form-control" id="tipeProduk" name="tipeProduk" placeholder="Tipe Produk"  value="{{old('tipeProduk')}}"/>
                        <span style="color: red;">{{ $errors->first('tipeProduk')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"  style="font-size: 16px">Harga</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Harga"  value="{{old('hargaProduk')}}" />
                            <span style="color: red;">{{ $errors->first('hargaProduk')}}</span>
                        </div>
                    </div>
                    


            </div>
            <br>
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Template Produk</h3>
                <h5 class="test-dark">pilih template yang digunakan untuk produk ini <span style="color: red">(pilih 1)</span></h5>

                <table id="tTemplate" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>Pilih </th>
                            <th>Informasi</th>
                            {{-- <th>tipe</th>
                            <th>Harga</th>
                            <th>Keterangan</th> --}}

                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listTemplate); $i++ )



                        <tr>
                            <td>
                                <div class="form-check mt-3">
                                    <input
                                    name="templatePilihan"
                                    class="form-check-input"
                                    type="radio"
                                    value="{{$listTemplate[$i]->id}}"
                                    id="defaultRadio1"
                                    />
                                    <label class="form-check-label" for="defaultRadio1"> Pilih </label>
                                </div>
                            </td>
                            <td style="font-size: 16px">
                                <div style="float: left">
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#modalImage{{$i}}"><img src="{{url("/storage/imgTemplate/".$listTemplate[$i]->gambar)}}" alt="" style="width:70px; height:70px" ></a>
                                        <b>{{$listTemplate[$i]->nama}}</b>
                                </div>
                            </td>

                            {{-- <td style="font-size: 16px"><b>{{$listTemplate[$i]->tipe}}</b></td>

                            <td style="font-size: 16px"><b>Rp {{$listTemplate[$i]->harga}}</b></td>
                            <td style="font-size: 16px"><b>{{$listTemplate[$i]->keterangan}}</b></td> --}}




                        </tr>

                        <div id="modalImage{{$i}}" class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%; height: 100%;">




                            <div class="modal-dialog">
                                <div class="modal-content" style="margin: auto;display: block;width: 80%;max-width: 700px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="modal-content" src="{{url("/storage/imgTemplate/".$listTemplate[$i]->gambar)}}"  >


                                </div>

                              </div>
                            </div>
                          </div>


                        @endfor









                    </tbody>

                </table>




            </div>
            <br>
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Add On Produk</h3>
                <h5 class="test-dark">pilih template yang digunakan untuk produk ini <span style="color: red">(bisa pilih lebih dari 1)</span></h5>

                <div class="table-responsive text-nowrap p-3">
                    <table id="tAddOn" class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Informasi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @for ($i=0; $i < count($listAddOn); $i++ )

                            <tr>
                                <td>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="addon[]" value="{{$listAddOn[$i]->id}}" id="defaultCheck{{$listAddOn[$i]->id}}" />
                                        <label class="form-check-label" for="defaultCheck{{$listAddOn[$i]->id}}"> Pilih </label>
                                      </div>
                                </td>
                                <td style="font-size: 16px">
                                    <div style="float: left">
                                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalImage{{$i}}"><img src="{{url("/storage/imgAddOn/".$listAddOn[$i]->gambar)}}" alt="" style="width:70px; height:70px" ></a>
                                            <b>{{$listAddOn[$i]->nama}}</b>
                                    </div>
                                </td>
{{--
                                <td style="font-size: 16px"><b>{{$listAddOn[$i]->tipe}}</b></td>

                                <td style="font-size: 16px"><b>Rp {{$listAddOn[$i]->harga}}</b></td>
                                <td style="font-size: 16px"><b>{{$listAddOn[$i]->keterangan}}</b></td> --}}



                            </tr>


                            <div id="modalImage{{$i}}" class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%; height: 100%;">

                                <div class="modal-dialog">
                                    <div class="modal-content" style="margin: auto;display: block;width: 80%;max-width: 700px;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="modal-content" src="{{url("/storage/imgAddOn/".$listAddOn[$i]->gambar)}}"  >

                                    </div>

                                  </div>
                                </div>
                              </div>

                            @endfor

                        </tbody>

                    </table>

                </div>

            </div>
            <br>
            <div style="float: right">
                <a href="{{url('/seller/produk/daftarProduk')}}" class="btn btn-outline-dark">Kembali</a>
                <button class="btn btn-primary">Tambah</button>
            </div>


    </form>


    </div>


    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
  </div>

  <script>




</script>


@endsection


@section('script')

<script>

$(document).ready( function () {
        $('#tTemplate').DataTable();
        $('#tAddOn').DataTable();






    });



  </script>

@endsection


