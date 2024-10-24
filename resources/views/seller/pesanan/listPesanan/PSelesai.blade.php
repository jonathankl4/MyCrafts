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
            <h2 class="fw-bold py-3 mb-4">Daftar Pesanan</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}
            <div class="">

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">

                            <a href="{{url('/seller/pesanan')}}" class="nav-link">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/nonCustom')}}" class="nav-link">
                                Non Custom
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/custom')}}" class="nav-link">
                                Custom
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/produksi')}}" class="nav-link">
                                Proses Produksi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/siapDikirim')}}" class="nav-link">
                                Siap Dikirim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/dalamPengiriman')}}" class="nav-link">
                                Dalam Pengiriman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/selesai')}}" class="nav-link active">
                                Pesanan Selesai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/seller/pesanan/batal')}}" class="nav-link">
                                Dibatalkan
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="card" style="padding: 15px">
                <h5 class="card-header"></h5>



                {{-- ini jika mau table nya responsive --}}
                {{-- <div class="table-responsive text-nowrap p-3"> --}}
                <div class="table-responsive">
                    <table id="tMebel" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Tipe Transaksi</th>
                                <th>Tanggal Transaksi</th>

                                <th>Status Pesanan</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

                            @for ($i = 0; $i < count($pembelian); $i++)
                                <tr>

                                    <td style="font-size: 16px"><b>{{ $pembelian[$i]->nama_produk }}</b></td>
                                    <td style="font-size: 16px"><b>{{ $pembelian[$i]->tipe_trans }}</b></td>
                                    <td style="font-size: 16px">
                                        <b>{{ \Carbon\Carbon::parse($pembelian[$i]->tgl_transaksi)->translatedFormat('j F Y') }}</b>
                                    </td>

                                    @php
                                        $s = $pembelian[$i]->status;
                                        $status = '';
                                        $color = '';
                                        if ($s == 1) {
                                            $status = 'Belum Di konfirmasi';
                                            $color = 'bg-warning';
                                        } elseif ($s == 2) {
                                            $status = 'Pengajuan Perbaikan desain, Menunggu Pembayaran';
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
                                        }

                                    @endphp
                                    <td style="font-size: 16px"><b><span
                                                class="badge {{ $color }}">{{ $status }}</span></b></td>

                                    <td>

                                        <a href="{{ url('seller/detailPesanan/' . $pembelian[$i]->id) }}"
                                            class="btn btn-info">Detail Pesanan</a>
                                    </td>


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
            $('#tMebel').DataTable({
                "order": [
                    [2, "desc"]
                ]
            });


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
