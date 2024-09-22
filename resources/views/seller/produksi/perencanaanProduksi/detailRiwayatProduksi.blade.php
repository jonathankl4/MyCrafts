@extends('template.MasterDesain')

@section('title', 'Detail Perencanaan Produksi')

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
            <h2 class="fw-bold py-3 mb-4">Detail Produksi</h2>

            <div class="card" style="padding: 15px">


                <div style="float: left">
                    <a href="{{ url('/seller/produksi/perencanaanProduksi') }}" class="btn btn-primary">Kembali</a>
                    @if ($produksi->status == '0' || $produksi->status == '1')
                        <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit
                            Produksi</a>
                        <a href="" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalDelete">Batalkan</a>
                    @endif

                    @if ($produksi->status == '1')
                        {{-- <a href="" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modalSelesai">Selesai</a> --}}
                        <a href="{{url('/seller/penyelesaianProduksi/'.$produksi->id)}}" class="btn btn-success" >Selesai</a>
                    @endif
                    
                </div>
                @php

                @endphp


                <h5 class="card-header">Detail Produksi</h5>
                <p> Nama Produk : {{ $produksi->nama_produk }} </p>
                <p> Jumlah Produksi : {{ $produksi->jumlahdiproduksi }} </p>
                <p> Tanggal Produksi : {{ $produksi->tgl_produksi_mulai }} </p>
                <p> Biaya produksi : {{ $bom->total_biaya }} </p>
                <p> Status Produksi : <span class="badge {{ $color }}">{{ $status }}</span></p>

            </div>
            <br>
            <div class="card" style="padding: 15px">
                {{-- ini jika mau table nya responsive --}}
                <div class="table-responsive text-nowrap p-3">
                    <div class="">
                        <h5>Penggunaan Bahan</h5>
                        <table id="tMebel" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah</th>
                                    


                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($listBahan); $i++)
                                    <tr>
                                        {{-- <td>{{$i+1}}</td> --}}
                                        <td style="font-size: 16px"><b>{{ $i + 1 }}</b></td>
                                        <td style="font-size: 16px"><b>{{ $listBahan[$i]->nama_bahan }}</b></td>
                                        <td style="font-size: 16px"><b>{{ $listBahan[$i]->jumlah_penggunaan }}</b></td>
                                        






                                    </tr>
                                @endfor

                            </tbody>

                        </table>

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
        $(document).ready(function() {
            $('#tMebel').DataTable();






        });
    </script>
@endsection
