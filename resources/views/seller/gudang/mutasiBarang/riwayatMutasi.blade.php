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
            <h2 class="fw-bold py-3 mb-4">Mutasi</h2>


            <div class="card" style="padding: 15px">
                <h5 class="card-header">Riwayat Mutasi Masuk dan Keluar barang</h5>
                <button class="btn btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modalAdd"
                    style="width: fit-content; margin-left: 10px"> Tambah Mutasi</button>
                <div class="table-responsive text-nowrap p-3">
                    <table id="tsatuan" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jenis Mutasi</th>
                                <th>Jumlah</th>

                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($riwayat); $i++)
                                <tr>
                                    
                                    <td>{{ \Carbon\Carbon::parse($riwayat[$i]->created_at)->translatedFormat('j F Y, H:i') }}</td>
                                    <td style="font-size: 16px"><b>{{ $riwayat[$i]->nama_barang }}</b></td>
                                    @if ($riwayat[$i]->jenis_barang == 'Mebel')

                                    <td style="font-size: 16px"><span class="badge" style="background-color: #bfb596; color: black">{{ $riwayat[$i]->jenis_barang }}</span></td>
                                    @else
                                    <td style="font-size: 16px"><span class="badge" style="background-color: #fdf0ca; color: black">{{ $riwayat[$i]->jenis_barang }}</span></td>

                                    @endif
                                    @if ($riwayat[$i]->jenis_mutasi == 'masuk')
                                        <td style="font-size: 16px"> <span
                                                class="badge bg-success">{{ $riwayat[$i]->jenis_mutasi }}</span> </td>
                                        <td style="font-size: 16px"><b>{{ $riwayat[$i]->stok_masuk }}</b></td>
                                    @else
                                        <td style="font-size: 16px"><span
                                                class="badge bg-danger">{{ $riwayat[$i]->jenis_mutasi }}</span> </td>
                                        <td style="font-size: 16px"><b>{{ $riwayat[$i]->stok_keluar }}</b></td>
                                    @endif



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
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background-color: #f4f4f4;">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Pilih Mutasi</h5> --}}

                </div>
                <div class="modal-body" style="text-align: center; padding: 30px;">
                    <h1 style="font-size: 24px; color: #333;">Pilih Mutasi</h1>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalMutasiMebel" class="btn btn-lg"
                        style="background-color: #898063; color: white; margin: 10px 0; width: 100%;">Mutasi Mebel</a>
                    {{-- <a href="{{url('/seller/gudang/mutasiMebel')}}" class="btn btn-lg" style="background-color: #898063; color: white; margin: 10px 0; width: 100%;">Mutasi Mebel</a> --}}
                    {{-- <a href="{{url('/seller/gudang/mutasiBahan')}}" class="btn btn-lg" style="background-color: #bfb596; color: white; margin: 10px 0; width: 100%;">Mutasi Bahan</a> --}}
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalMutasiBahan" class="btn btn-lg"
                        style="background-color: #bfb596; color: white; margin: 10px 0; width: 100%;">Mutasi Bahan</a>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="padding: 10px 20px; border-radius: 5px;">Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Mutasi Mebel -->
    <div class="modal fade" id="modalMutasiMebel" tabindex="-1" aria-labelledby="modalMutasiMebelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background-color: #f4f4f4;">
                    <h5 class="modal-title" id="modalMutasiMebelLabel">Mutasi Stok Mebel</h5>
                </div>
                <div class="modal-body" style="text-align: center; padding: 30px;">
                    <h1 style="font-size: 24px; color: #333;">Mutasi Stok Masuk / Keluar Mebel</h1>

                    <form action="{{url('seller/gudang/inputMutasi')}}" method="POST" id="mutasiMebelForm">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="mebel">
                        <div class="mb-3">
                            <label for="id_mebel" class="form-label">Pilih Mebel</label>
                            <select name="id_mebel" id="id_mebel" class="form-select" onchange="getStokMebel(this)">
                                <option value="">Pilih Mebel</option>
                                @foreach ($listMebel as $mebel)
                                    <option value="{{ $mebel->id }}">{{ $mebel->nama_mebel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stok_mebel" class="form-label">Stok Sekarang</label>
                            <input type="text" id="stok_mebel" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_mutasi_mebel" class="form-label">Jenis Mutasi</label>
                            <select name="jenis_mutasi" id="jenis_mutasi_mebel" class="form-select">
                                <option value="masuk">Stok Masuk</option>
                                <option value="keluar">Stok Keluar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_mebel" class="form-label">Jumlah Stok</label>
                            <input type="number" name="jumlah" id="jumlah_mebel" class="form-control"
                                placeholder="Masukkan jumlah stok">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Simpan Mutasi</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mutasi Bahan -->
    <div class="modal fade" id="modalMutasiBahan" tabindex="-1" aria-labelledby="modalMutasiBahanLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background-color: #f4f4f4;">
                    <h5 class="modal-title" id="modalMutasiBahanLabel">Mutasi Stok Bahan</h5>
                </div>
                <div class="modal-body" style="text-align: center; padding: 30px;">
                    <h1 style="font-size: 24px; color: #333;">Mutasi Stok Masuk / Keluar Bahan</h1>

                    <form action="{{url('seller/gudang/inputMutasi')}}" method="POST" id="mutasiBahanForm">
                        @csrf
                        <input type="hidden" name="jenis_barang" value="bahan">
                        <div class="mb-3">
                            <label for="id_bahan" class="form-label">Pilih Bahan</label>
                            <select name="id_bahan" id="id_bahan" class="form-select" onchange="getStokBahan(this)">
                                <option value="">Pilih Bahan</option>
                                @foreach ($listBahan as $bahan)
                                    <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stok_bahan" class="form-label">Stok Sekarang</label>
                            <div class="input-group input-group-merge">

                                <input type="text" id="stok_bahan" class="form-control" style="border: 1.3px ridge " readonly>

                                <span class="input-group-text " id="labelJumlah"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_mutasi_bahan" class="form-label">Jenis Mutasi</label>
                            <select name="jenis_mutasi" id="jenis_mutasi_bahan" class="form-select">
                                <option value="masuk">Stok Masuk</option>
                                <option value="keluar">Stok Keluar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_bahan" class="form-label">Jumlah Stok</label>
                            <input type="number" name="jumlah" id="jumlah_bahan" class="form-control"
                                placeholder="Masukkan jumlah stok">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Simpan Mutasi</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tsatuan').DataTable();






        });
    </script>


    <script>
        // Fungsi untuk mendapatkan stok mebel
        function getStokMebel(select) {
            let mebelId = select.value;
            if (mebelId) {
                fetch(`/seller/api/get-stok-mebel/${mebelId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('stok_mebel').value = data.stok_sekarang;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('stok_mebel').value = '';
            }
        }

        // Fungsi untuk mendapatkan stok bahan
        function getStokBahan(select) {
            let bahanId = select.value;
            if (bahanId) {
                fetch(`/seller/api/get-stok-bahan/${bahanId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('stok_bahan').value = data.stok_sekarang;
                        document.getElementById('labelJumlah').textContent = data.satuan;

                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('stok_bahan').value = '';
            }
        }
    </script>
@endsection
