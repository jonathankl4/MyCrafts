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
            produksi akan mulai otomatis sesuai dengan tanggal produksi
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
                <p> Perkiraan Biaya produksi : {{ $bom->total_biaya }} </p>
                <p> Status Produksi : <span class="badge {{ $color }}">{{ $status }}</span></p>

            </div>
            <br>
            <div class="card" style="padding: 15px">
                {{-- ini jika mau table nya responsive --}}
                <div class="table-responsive text-nowrap p-3">
                    <div class="">
                        <h5>Bill Of Material</h5>
                        <table id="tMebel" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah</th>
                                    <th>Ukuran</th>








                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($listDetail); $i++)
                                    <tr>
                                        {{-- <td>{{$i+1}}</td> --}}
                                        <td style="font-size: 16px"><b>{{ $i + 1 }}</b></td>
                                        <td style="font-size: 16px"><b>{{ $listDetail[$i]->nama_bahan }}</b></td>
                                        <td style="font-size: 16px"><b>{{ $listDetail[$i]->jumlah }}</b></td>
                                        <td style="font-size: 16px"><b>
                                                <p>{{ $listDetail[$i]->ukuran_bahan }}</p>

                                            </b></td>






                                    </tr>
                                @endfor







                            </tbody>

                        </table>

                    </div>
                </div>
            </div>










            {{-- Modal Batalkan Produksi --}}
            <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2 class="card-title text-primary"> Yakin batalkan produksi {{ $produksi->nama_produk }} ?
                            </h2>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ url('seller/batalkanProduksi/' . $produksi->id) }}">

                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Yakin</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            {{-- MOdal Selesaikan Produksi --}}
            <div class="modal fade" id="modalSelesai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                        </div>
                    </div>
                </div>
            </div>


            {{-- Modal Edit Produksi --}}

            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2 class="card-title text-primary"> Edit Produksi </h2>
                            <form action="{{ url('seller/editProduksi/' . $produksi->id) }}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-md-2 col-form-label" style="font-size: 16px">Tanggal
                                        Produksi</label>
                                    <div class="col-md-10">


                                        <input type="date" class="form-control" id="tglProduksi" required
                                            name="tglProduksi" value={{ $produksi->tgl_produksi_mulai }} />
                                        <span style="color: red;">{{ $errors->first('tglProduksi') }}</span>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-2 col-form-label" style="font-size: 16px">Jumlah Produksi</label>
                                    <div class="col-md-10">

                                        <input type="number" class="form-control" id="jumlahProduksi" required
                                            name="jumlahProduksi" placeholder="jumlah yang diproduksi"
                                            value="{{ $produksi->jumlahdiproduksi }}" />
                                        <span style="color: red;">{{ $errors->first('jumlahProduksi') }}</span>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>


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
        $(document).ready(function() {
            $('#tMebel').DataTable();






        });
    </script>
@endsection
