@extends('template.MasterDesain')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Detail Pesanan')

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
            <h2 class="fw-bold py-3 mb-4">Detail Pesanan</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}
            <div class="row" style="padding: 10px">
                <div class="col-md-4">


                    <div class="card" style="padding: 15px">
                        @if ($detail->status == 4)
                            <button class="btn" style="margin: 5px; background-color: #898063; color: black">
                                Produksi Selesai
                            </button>
                        @elseif ($detail->status == 11)
                            <button class="btn" style="margin: 5px; background-color: #898063; color: black">
                                Kirim Barang
                            </button>
                        @endif
                    </div>
                    <br>
                    <div class="card " style="padding: 15px">



                        <div class="row">
                            <span>Tanggal dan Status Transaksi</span>
                            <span style="font-size: 20px"><b>
                                    {{ \Carbon\Carbon::parse($detail->tgl_transaksi)->translatedFormat('j F Y') }}
                                </b></span>
                            @php
                                $s = $detail->status;
                                $status = '';
                                $color = '';
                                if ($s == 1) {
                                    $status = 'Belum Di konfirmasi';
                                    $color = 'bg-warning';
                                } elseif ($s == 2) {
                                    $status = 'Perbaikan, menunggu Pembayarab';
                                    $color = 'bg-secondary';
                                } elseif ($s == 3) {
                                    $status = 'Menunggu Pembayaran Customer';
                                    $color = 'bg-info';
                                } elseif ($s == 4) {
                                    $status = 'Dalam Proses Produksi';
                                    $color = 'bg-success';
                                } elseif ($s == 5) {
                                    $status = 'Siap Dikirim';
                                    $color = 'bg-dark';
                                } elseif ($s == 6) {
                                    $status = 'Dalam Pengiriman';
                                    $color = 'bg-dark';
                                } elseif ($s == 7) {
                                    $status = 'Pesanan Selesai';
                                    $color = 'bg-dark';
                                } elseif ($s == 8) {
                                    $status = 'Pesanan Batal';
                                    $color = 'bg-dark';
                                } elseif ($s == 9) {
                                    $status = 'Pesanan Batal';
                                    $color = 'bg-dark';
                                } elseif ($s == 10) {
                                    $status = 'Pembayaran Batal';
                                    $color = 'bg-dark';
                                }

                            @endphp
                            <td style="font-size: 14px"><b><span
                                        class="badge {{ $color }}">{{ $status }}</span></b></td>
                        </div>
                        <br>
                        <div class="row">
                            <span>Tipe Transaksi</span>
                            <span style="font-size: 20px"><b>{{ $detail->tipe_trans }}</b> </span>
                        </div>
                        <br>
                        <div class="row">
                            <span>Jenis Kayu dan Ukuran</span>
                            <span style="font-size: 20px"><b>{{ $detail->jenis_kayu }}</b> </span>
                            @if (str_contains(strtolower($produk->kode), 'lemari'))
                                <span style="font-size: 20px"><b>
                                        Lebar: {{ $detail->lebar }}cm,
                                    </b>
                                </span>
                                <span style="font-size: 20px"><b>
                                Tinggi: {{ $detail->tinggi }}cm,
                                    </b>
                                </span>
                                <span style="font-size: 20px"><b>
                                Tebal (kedalaman): {{ $detail->panjang }}cm
                                    </b>
                                </span>


                            @else
                                <span style="font-size: 20px"><b>Lebar: {{ $detail->lebar }}cm,
                                        Tinggi:{{ $detail->tinggi }}cm,
                                        Panjang: {{ $detail->panjang }}cm </b>
                                </span>
                            @endif
                        </div>
                        <br>
                        <div class="row">
                            <span>Finishing</span>
                            <span style="font-size: 20px"><b>{{ $detail->finishing }}</b> </span>

                        </div>
                        <br>
                        <div class="row">
                            <span>Perkiraan Harga</span>
                            <span style="font-size: 20px"><b>Rp.
                                    {{ number_format($detail->perkiraan_harga, 0, ',', '.') }}</b> </span>
                        </div>
                        <br>
                        <div class="row">
                            <span style="font-size: 20px"><b>Penjelasan Pembelian</b></span>
                            <span> {{ $detail->catatan }} </span>
                        </div>








                    </div>
                    <br>
                    <div class="card " style="padding: 15px">

                        <h3>Daftar AddOn</h3>
                        @for ($i = 0; $i < count($addon); $i++)
                            @if ($addon[$i]->jenis == 'second')
                                <div>
                                    <span><b> </b> </span> <span> {{ $addon[$i]->nama_item }} </span>

                                </div>
                            @else
                                @if ($addon[$i]->cek_redesain != 'yes')
                                    <div>
                                        <span><b>{{ $addon[$i]->nama_item }} :</b> </span>
                                        <span>{{ $addon[$i]->jumlah }} </span>
                                    </div>
                                @endif
                            @endif
                        @endfor






                    </div>


                </div>


                <div class="col-md-8">

                    <div class="card " style="padding: 15px">
                        <h3 class="card-header"><b>Desain</b></h3>


                        <div class="row">
                            @if (str_contains($detail->nama_produk, 'lemari'))
                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoh1) }}"
                                    style="width: 300px;height:450px">

                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoh2) }}"
                                    style="width: 300px;height:450px">
                            @else
                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoh1) }}" style="">

                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoh2) }}" style="">
                            @endif

                        </div>
                        <br>


                        {{-- Terima Pesanan --}}
                        @if ($detail->status == 1)
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalTerimaPesanan"
                                style="margin: 5px; background-color: #898063; color: black">
                                Terima Pesanan
                            </button>

                            {{-- Terima dengan perbaikan desain --}}
                            <a href="{{ url('/seller/custom/redesain/' . $detail->id) }}" class="btn "
                                style="margin: 5px ;background-color: #bfb596; color: black">Terima Dengan Perbaikan
                                Desain</a>

                            {{-- Tolak Pesanan --}}
                            <a href="" class="btn btn-danger"
                                style="margin: 5px;background-color: #fb8d76; color: black " data-bs-toggle="modal"
                                data-bs-target="#modalTolakPesanan">Batalkan Pesanan</a>
                        @elseif ($detail->status == 2)
                            <button class="btn" style="background-color: #bfb596; color: black" data-bs-toggle="modal"
                                data-bs-target="#modalDesainBaru">Lihat Perbaikan Desain</button>
                        @endif





                    </div>
                    <br>
                    <div class="card" style="padding: 15px">
                        <div class="row">

                            <label for="" style="font-size: 20px"><b>Alamat Pengiriman</b></label>
                            <label for="">{{ $detail->alamat }}</label>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" style="font-size: 20px"><b>Nomor WhatsApp</b></label>
                            <label for="">{{ $detail->nomorTelepon }}</label>
                        </div>
                    </div>
                </div>
            </div>







        </div>

        <div class="modal fade" id="modalTolakPesanan" tabindex="-1" aria-labelledby="modalTolakPesananLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ url('/seller/pesanan/batalkan/' . $detail->id) }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #bfb596; color: white;">
                            <h5 class="modal-title" id="modalTolakPesananLabel">Batalkan Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="padding: 25px;">

                            <div class="mb-3">
                                <label for="alasan" class="form-label"
                                    style="font-weight: 500; color: #6c757d;">Keterangan Pembatalan Pesanan</label>
                                <textarea name="alasan" id="alasan" class="form-control"
                                    style="padding: 10px; border: 1px solid #ced4da; border-radius: 5px; width: 100%;" cols="30" rows="5"
                                    placeholder="Masukkan alasan pembatalan..." required></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                style="background-color: #6c757d; border-color: #6c757d;">Tutup</button>
                            <button type="submit" id="confirmOrder" class="btn btn-success"
                                style="background-color: #28a745; border-color: #28a745;">Konfirmasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="modalTerimaPesanan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bfb596; color: white;">
                        {{-- <h5 class="modal-title" id="exampleModalLabel">Pesanan Baru</h5> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <h2 class="card-title text-dark" style="font-weight: bold;"> Terima Pesanan </h2>
                        <form id="myForm">
                            <div class="mb-3">
                                <label for="" style="font-size: 18px; font-weight: bold;"> Perkiraan Harga: <span
                                        style="color: #3c7e63;">Rp
                                        {{ number_format($detail->perkiraan_harga, 0, ',', '.') }}</span></label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Fix</label>
                                <input type="number" class="form-control" id="hargafix" name="hargafix" required />
                                {{-- <span style="color: red">*Harga Fix yang harus dibayarkan oleh customer</span> --}}
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-size: 16px; font-weight: 500;">Ongkir</label>
                                <input type="number" class="form-control" id="ongkir" name="ongkir" required
                                    placeholder="Masukkan ongkir" />
                                <small style="color: red;">*Total yang harus dibayarkan customer (harga + ongkir)</small>
                            </div>
                            <button type="button" class="btn" id="terimaPesanan"
                                style="background-color: #bfb596; color: black; width: 100%; padding: 10px; font-size: 16px;">Terima</button>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="padding: 8px 16px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalConfirmPesanan" tabindex="-1" aria-labelledby="modalConfirmPesananLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bfb596; color: white;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <h3 class="text-dark" style="font-weight: bold;">Konfirmasi</h3>
                        <p>Total yang harus dibayar adalah: <span id="totalAmount"
                                style="font-weight: bold; color: #3c7e63;"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="konfirmasi" class="btn btn-success">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDesainBaru" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="card-title "> Perbaikan Desain </h2>

                        @if ($detail->status == 2)
                            @if (str_contains($detail->nama_produk, 'lemari'))
                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoredesain) }}"
                                    style="width: 300px;height:450px">
                            @else
                                <img src="{{ url('/storage/hasilcustom/' . $detail->fotoredesain) }}" style=""
                                    class="modal-content">
                            @endif
                        @endif

                        {{-- <form id="myForm">
                        <div class="mb-3">
                            <label class="form-label">Harga Fix</label>
                            <input type="number" class="form-control" id="hargafix" name="hargafix" required />
                            <span style="color: red">*Harga Fix yang harus dibayarkan oleh customer</span>
                        </div>
                        <button class="btn" id="terimaPesanan" style="background-color: #3c7e63; color: white">Kirim</button>
                    </form> --}}
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
        $(document).ready(function() {
            $('#tMebel').DataTable();


        });
    </script>

    <script>
        let htrans = @json($detail);

        document.getElementById('terimaPesanan').addEventListener('click', function() {
            // Get harga and ongkir values
            var hargaInput = document.getElementById('hargafix');
            var ongkirInput = document.getElementById('ongkir');
            var harga = parseInt(hargaInput.value);
            var ongkir = parseInt(ongkirInput.value);


            // Check if ongkir and harga fix is filled and valid
            if (!hargaInput.value || isNaN(harga) || harga <= 0) {
                alert("Masukkan harga Fix yang valid sebelum melanjutkan.");
                hargaInput.focus();
                return;
            }
            if (!ongkirInput.value || isNaN(ongkir) || ongkir <= 0) {
                alert("Masukkan ongkir yang valid sebelum melanjutkan.");
                ongkirInput.focus();
                return;
            }

            // Calculate total and display in the confirmation modal
            var total = harga + ongkir;
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString();

            // Show the confirmation modal
            var confirmModal = new bootstrap.Modal(document.getElementById('modalConfirmPesanan'));
            confirmModal.show();
        });


        document.getElementById('konfirmasi').addEventListener('click', function(event) {
            // Ambil form element
            const form = document.getElementById('myForm');

            // Cek validasi form
            if (form.checkValidity()) {
                event.preventDefault(); // Mencegah submit default jika valid

                const fixHarga = document.getElementById('hargafix').value;
                const ongkir = document.getElementById('ongkir').value;
                document.getElementById('loadingScreen').style.display = 'block';
                fetch('/seller/custom/terimaPesanan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            fixHarga: fixHarga,
                            id_htrans: htrans.id,
                            ongkir: ongkir
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ url('/seller/pesanan') }}";
                        } else {
                            alert("Gagal mengirim data");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim data');
                    })
                    .finally(() => {
                        // Sembunyikan loading screen setelah proses selesai
                        document.getElementById('loadingScreen').style.display = 'none';
                    });
            } else {
                // Jika form tidak valid, browser akan menampilkan pesan kesalahan
                form.reportValidity(); // Menampilkan pesan error bawaan browser
            }
        });
    </script>
@endsection
