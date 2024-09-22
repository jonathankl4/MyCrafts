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
        <h2 class="fw-bold py-3 mb-4">Riwayat Input Hasil Produksi</h2>

        <div class="card" style="padding: 15px">
            <h5 class="card-header"></h5>



            {{-- ini jika mau table nya responsive --}}
            {{-- <div class="table-responsive text-nowrap p-3"> --}}
            <div class="">
                <table id="tMebel" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produksi</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Produksi</th>
                            <th>Durasi Produksi</th>
                            <th>Status</th>
                            <th>Aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i < count($listRiwayat); $i++ )

                        <tr>
                            <td>{{$i+1}}</td>
                            <td style="font-size: 16px"><b>{{$listRiwayat[$i]->kode_produksi}}</b></td>
                            <td style="font-size: 16px"><b>{{$listRiwayat[$i]->nama_produk}}</b></td>
                            <td style="font-size: 16px"><b>Total : {{$listRiwayat[$i]->jumlahdiproduksi}}</b><p>berhasil = {{$listRiwayat[$i]->jumlah_berhasil}}</p><p>gagal = {{$listRiwayat[$i]->jumlah_gagal}}</p></td>
                            <td style="font-size: 16px"><b>{{$listRiwayat[$i]->durasi +1}} Hari</b></td>

                            @php
                                $s = $listRiwayat[$i]->status;
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
                            <td style="font-size: 16px"><span class="badge {{$color}}">{{$status}}</span></td>
                            <td style="font-size: 16px">
                                <a href="{{url('/seller/detailRiwayatProduksi/'.$listRiwayat[$i]->kode_produksi)}}" class="btn btn-info">detail</a>
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
                                    <h2 class="card-title text-primary"> Yakin batalkan produksi ? </h2>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{url('seller/batalkanProduksi/'.$listRiwayat[$i]->id)}}">

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
