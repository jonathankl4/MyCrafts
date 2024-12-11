@extends('template.BackupMasterDesain')

@section('title', 'Tambah Produksi')

@section('style')
    <style>






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
            <h2 class="fw-bold  mb-4">Penyelesaian Produksi</h2>


            <a href="{{url('/seller/pDetailProduksi/'.$produksi->id)}}" class="btn btn-primary">Kembali</a>
            <br><br>
            <form action="{{ url('/seller/simpanHasilProduksi') }}" method="post">
                @csrf
                <div class="card" style="padding: 15px">


                    <h3>Input Hasil Produksi</h3>

                    <p>Jumlah Produksi : {{ $produksi->jumlahdiproduksi }}</p>
                    <input type="text" name="id_produksi" hidden value="{{ $produksi->id }}">
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">Jumlah Produk Berhasil</label>


                        <input type="number" class="form-control" id="jumlahBerhasil" name="jumlahBerhasil"
                            placeholder="jumlah yang berhasil diproduksi" required />
                        <span style="color: red;">{{ $errors->first('jumlahBerhasil') }}</span>


                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">Jumlah Produk Gagal</label>


                        <input type="number" class="form-control" id="jumlahGagal" name="jumlahGagal"
                            placeholder="jumlah yang gagal diproduksi" required />
                        <span style="color: red;">{{ $errors->first('jumlahGagal') }}</span>


                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">Keterangan gagal produksi (opsional) </label>


                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="keterangan" value="{{ old('keterangan') }}" />
                        <span style="color: red;">{{ $errors->first('keterangan') }}</span>


                    </div>

                    <div></div>








                </div>
                <br>
                <div class="card" style="padding: 15px">
                    <h3>Penggunaan Bahan</h3>

                    <table id="tMebel" class="table table-striped" >
                        <thead>
                            <tr>
                                <th hidden>id bahan</th>
                                <th>Nama Bahan</th>
                                <th>Jumlah Penggunaan</th>
                                <th>Satuan</th>






                            </tr>
                        </thead>
                        <tbody>


                            @for ($i=0; $i < count($listBahan); $i++ )

                            <tr>


                                <td hidden style="font-size: 16px"><input type="text" name="id_bahan[]" value="{{$listBahan[$i]->id_bahan}}"></td>
                                <td style="font-size: 16px"> <input type="text" name="namabahan[]" value="{{$listBahan[$i]->nama_bahan}}" readonly style="border: none"></td>
                                <td style="font-size: 16px"><input type="text" placeholder="Jumlah" name="jumlah[]"></td>
                                <td style="font-size: 16px">{{$listBahan[$i]->satuan_jumlah}}</td>






                            </tr>






                            @endfor







                        </tbody>

                    </table>


                </div>
                <br>

                <button class="btn btn-success">Simpan</button>

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





@endsection

@section('script')

    <script>
        $(".theSelect").select2();
    </script>

    <script language='javascript'>
        function ambildata() {

            let anjay = $('#billOfMaterial').val();

            // window.alert(anjay);

            $.ajax({
                type: 'get',
                url: '{{ url('seller/getBom') }}',
                data: {
                    'id': anjay
                },
                success: function(data) {

                    // console.log(data)
                    $('#namaProduk').val(data['nama_product']);




                }
            })
        }
    </script>
@endsection
