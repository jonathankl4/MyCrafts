@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

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
            <h2 class="fw-bold py-3 mb-4">Daftar Produk Custom</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}

            <div class="card" style="padding: 15px">
                <h5 class="card-header"></h5>



                {{-- ini jika mau table nya responsive --}}
                {{-- <div class="table-responsive text-nowrap p-3"> --}}
                <div class="">
                    <table id="tMebel" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Template</th>
                                <th>Nama Produk</th>
                                <th>Status</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

                            @for ($i = 0; $i < count($daftarProduk); $i++)
                                <tr>
                                    <td>1</td>
                                    <td style="font-size: 16px">
                                        <b> {{ $daftarProduk[$i]->nama_template }} </b>
                                    </td>
                                    <td style="font-size: 16px">
                                        <b> {{ $daftarProduk[$i]->nama_produk }} </b>
                                    </td>
                                    <td style="font-size: 16px">
                                        @if ($daftarProduk[$i]->status == 'nonaktif')
                                            <div class="col-3 text-end">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input float-end"
                                                        id="statuscek{{ $daftarProduk[$i]->id }}" type="checkbox"
                                                        role="switch"
                                                        onchange="statuschange({{ $daftarProduk[$i]->id }})" />
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-3 text-end">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input float-end"
                                                        id="statuscek{{ $daftarProduk[$i]->id }}" type="checkbox"
                                                        role="switch" checked
                                                        onchange="statuschange({{ $daftarProduk[$i]->id }})" />
                                                </div>
                                            </div>
                                        @endif


                                    </td>


                                    <td>

                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalDetailProdukCustom{{ $i }}" class="btn "
                                            style="background-color: #898063; color: white">Detail Produk</a>
                                        <a href="{{ url('/seller/produkCustom/detailProdukCustom/' . $daftarProduk[$i]->id) }}"
                                            class="btn " style="background-color: #4b4737; color: white">Detail
                                            Kustomisai</a>
                                        <a href="{{ url('/seller/produkCustom/testing/' . $daftarProduk[$i]->kode) }}"
                                            class="btn btn-dark">Coba Custom</a>
                                            <a href="{{url('seller/produkCustom/delete/'.$daftarProduk[$i]->id)}}" class="btn btn-icon btn-danger"><span class="bx bxs-trash"></span></a>
                                    </td>

                                </tr>

                                {{-- modal edit Detail Produk --}}
                                <div class="modal fade" id="modalDetailProdukCustom{{ $i }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h2 class="card-title text-primary"> Edit </h2>

                                                <form
                                                    action="{{ url('seller/produkCustom/editDetailProduk') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="text" name="idProduk" id="idProduk" value="{{$daftarProduk[$i]->id}}" hidden>
                                                    <div class="mb-3 ">
                                                        <label class="" for="namaProduk"><b>Nama
                                                                Produk</b></label>
                                                        <div class="input-group">

                                                            <input type="text" class="form-control" id="namaProduk"
                                                                name="namaProduk" value="{{ $daftarProduk[$i]->nama_produk }}"
                                                                required />
                                                        </div>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for=""><b>Deskripsi</b></label>
                                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" required>{{$daftarProduk[$i]->deskripsi}}</textarea>
                                                    </div>
                                                    @if (in_array($daftarProduk[$i]->kode, ['meja1', 'meja2', 'meja3']))
                                                    <div class="mb-3">
                                                        <label><b>Panjang</b> (Minimal s/d Maksimal)</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="panjangMin"
                                                            name="panjangMin" value="{{ $daftarProduk[$i]->panjang_min }}"
                                                            required />
                                                        <span class="input-group-text">Cm</span>
                                                        <span class="input-group-text">s/d</span>
                                                        <input type="number" class="form-control" id="panjangMax"
                                                            name="panjangMax" value="{{ $daftarProduk[$i]->panjang_max }}"
                                                            required />
                                                        <span class="input-group-text">Cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label><b>Tinggi</b> (Minimal s/d Maksimal)</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="tinggiMin" name="tinggiMin"
                                                                value="{{ $daftarProduk[$i]->tinggi_min }}" required />
                                                            <span class="input-group-text">Cm</span>
                                                            <span class="input-group-text">s/d</span>
                                                            <input type="number" class="form-control" id="tinggiMax" name="tinggiMax"
                                                                value="{{ $daftarProduk[$i]->tinggi_max }}" required />
                                                            <span class="input-group-text">Cm</span>
                                                        </div>
                                                    </div>

                                                   <div class="mb-3">
                                                    <label><b>Lebar</b> (Minimal s/d Maksimal)</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="lebarMin" name="lebarMin"
                                                            value="{{ $daftarProduk[$i]->lebar_min }}" required />
                                                        <span class="input-group-text">Cm</span>
                                                        <span class="input-group-text">s/d</span>
                                                        <input type="number" class="form-control" id="lebarMax" name="lebarMax"
                                                            value="{{ $daftarProduk[$i]->lebar_max }}" required />
                                                        <span class="input-group-text">Cm</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="mb-3">
                                                    <label><b>Kedalaman</b> (Minimal s/d Maksimal)</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="panjangMin"
                                                        name="panjangMin" value="{{ $daftarProduk[$i]->panjang_min }}"
                                                        readonly />
                                                    <span class="input-group-text">Cm</span>
                                                    <span class="input-group-text">s/d</span>
                                                    <input type="number" class="form-control" id="panjangMax"
                                                        name="panjangMax" value="{{ $daftarProduk[$i]->panjang_max }}"
                                                        readonly />
                                                    <span class="input-group-text">Cm</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label><b>Tinggi</b> (Minimal s/d Maksimal)</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="tinggiMin" name="tinggiMin"
                                                            value="{{ $daftarProduk[$i]->tinggi_min }}" required />
                                                        <span class="input-group-text">Cm</span>
                                                        <span class="input-group-text">s/d</span>
                                                        <input type="number" class="form-control" id="tinggiMax" name="tinggiMax"
                                                            value="{{ $daftarProduk[$i]->tinggi_max }}" required />
                                                        <span class="input-group-text">Cm</span>
                                                    </div>
                                                </div>
                                                <label><b>Lebar</b> (Minimal s/d Maksimal)</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="lebarMin" name="lebarMin"
                                                        value="{{ $daftarProduk[$i]->lebar_min }}" />
                                                    <span class="input-group-text">Cm</span>
                                                    <span class="input-group-text">s/d</span>
                                                    <input type="number" class="form-control" id="lebarMax" name="lebarMax"
                                                        value="{{ $daftarProduk[$i]->lebar_max }}" />
                                                    <span class="input-group-text">Cm</span>
                                                </div>

                                                   @endif
                                                    <button class="btn btn-primary">Simpan</button>


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

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

    <script>
        function statuschange(id) {

            var x = document.getElementById("statuscek" + id).checked;
            var stat = "";
            var notif = ""
            if (x == true) {
                stat = "aktif";
                notif = "produk diaktifkan !"
            } else {
                stat = "nonaktif";
                notif = "produk di nonaktifkan !"
            }

            // $.post("{{ route('ubahStatusProduk') }}", {
            //     _method: 'POST',
            //     _token: '{{ csrf_token() }}',
            //     status : x,
            //     idProduk : id,
            // });
            $.post("{{ route('ubahStatusProdukCustom') }}", {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                status: stat,
                idProduk: id,
            });


            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: notif
            });



            // window.location.href = '{{ url('document.getElementById("status").value') }}';

        };
    </script>
@endsection
