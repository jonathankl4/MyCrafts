@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

@section('style')
    <style>
        .modal-dialog {
            max-width: 90%;
            margin: 1.75rem auto;
        }

        .carousel-item img {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .accordion-button:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .card {
            border: none;
            transition: all 0.3s ease;
        }



        .modal-header {
            border-radius: 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            padding: 15px;
        }

        .accordion-body img {
            transition: all 0.3s ease;
        }

        .accordion-body img:hover {
            transform: scale(1.05);
        }


        .specs-container {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }

        .specs-details {
            font-size: 0.95rem;
        }

        .spec-item h6 {
            color: #0d6efd;
        }

        .accordion-body {
            padding: 1.5rem;
        }

        .accordion-body img {
            transition: transform 0.3s ease;
        }

        .accordion-body img:hover {
            transform: scale(1.05);
        }

        .list-unstyled li {
            margin-bottom: 0.5rem;
        }

        /* Icon colors */
        .bi-rulers {
            color: #0d6efd;
        }

        .bi-info-circle {
            color: #0dcaf0;
        }

        .bi-lightning {
            color: #ffc107;
        }
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
            <h2 class="fw-bold py-3 mb-4">Daftar Template Produk Custom</h2>


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
                                <th>Nama Template</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>



                            @for ($i=0; $i<count($daftarProduk);$i++)
                            <tr>
                                <td>{{ $i+ 1 }}</td>
                                <td style="font-size: 16px">
                                    @if ($daftarProduk[$i]->tipe == "lemari")

                                    <img src="{{ url($daftarProduk[$i]->img) }}" alt="" style="width:50px; height:80px">
                                    @else
                                    <img src="{{ url($daftarProduk[$i]->img) }}" alt="" style="width:80px; height:50px">

                                    @endif
                                    <b>{{ $daftarProduk[$i]->nama }}</b>
                                </td>
                                <td>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi{{$i + 1}}">Tambah</button>
                                    @if ($daftarProduk[$i]->modal)
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="{{ $daftarProduk[$i]->modal }}">Info Detail</button>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="modalKonfirmasi{{$i + 1}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog " style="max-width: 50%">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="card-title "> Tambah Template </h2>
                                            <p>Saya Sudah membaca info detail dari Template dan Yakin menambah Template ini</p>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <a href="{{ url($daftarProduk[$i]->tambahUrl) }}" class="btn btn-success">Yakin</a>

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

        @include('seller.produkCustom.produk.modal.lemari1.modalDetailMebel')
        @include('seller.produkCustom.produk.modal.lemari2.modalDetailMebel')
        @include('seller.produkCustom.produk.modal.lemari3.modalDetailMebel')
        @include('seller.produkCustom.produk.modal.meja1.modalDetailMebel')
        @include('seller.produkCustom.produk.modal.meja2.modalDetailMebel')


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
