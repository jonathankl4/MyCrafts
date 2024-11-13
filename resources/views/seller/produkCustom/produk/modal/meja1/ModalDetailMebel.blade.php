<div class="modal fade" id="modalMeja1" tabindex="-1" aria-labelledby="modalcek" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalceklabel">Detail Custom Meja 1</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center text-primary border-bottom pb-2">Meja 1</h2>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="row">
                        <!-- Specifications Column -->
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">Spesifikasi</h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Ukuran:</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="bi bi-arrows-angle-expand me-2"></i>
                                            Lebar: 80 cm - 100 cm
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-arrows-angle-expand me-2"></i>
                                            Tinggi: 160 cm - 180 cm
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-arrows-angle-expand me-2"></i>
                                            Kedalaman: 45 cm - 60 cm
                                        </li>
                                    </ul>
                                    <div class="alert alert-info">
                                        <strong>Rangka Lemari:</strong>
                                        <p class="mb-0">Tebal kayu standar 1,5 - 3 cm (sesuai jenis kayu)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Template Images Column -->
                        <div class="col-md-8">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">Foto</h4>
                                </div>
                                <div class="card-body product-gallery">
                                    <div id="image-meja1" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active image-container">
                                                <img src="{{ asset('img/meja1/meja1.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 1">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/meja1/mj.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 2">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/meja1/meja1belakang.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 3">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#image-meja1" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#image-meja1" data-bs-slide="next">
                                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add-ons Accordion -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">List Add-on</h4>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="addonAccordionM1">
                                        <!-- Sekat Vertical -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingM1One">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseM1One" aria-expanded="false" aria-controls="collapseM1One">
                                                    Laci 1
                                                </button>
                                            </h2>
                                            <div id="collapseM1One" class="accordion-collapse collapse" aria-labelledby="headingM1One" data-bs-parent="#addonAccordionM1">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lacikecil.png') }}" alt="Sekat Vertical" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.laci1')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sekat Horizontal -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingM1Two">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseM1Two" aria-expanded="false" aria-controls="collapseM1Two">
                                                    Laci 2
                                                </button>
                                            </h2>
                                            <div id="collapseM1Two" class="accordion-collapse collapse" aria-labelledby="headingM1Two" data-bs-parent="#addonAccordionM1">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/lacikecil2.png') }}" alt="Sekat Horizontal" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.laci2')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gantungan -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingM1Three">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseM1Three" aria-expanded="false" aria-controls="collapseM1Three">
                                                    Pijakan Kaki
                                                </button>
                                            </h2>
                                            <div id="collapseM1Three" class="accordion-collapse collapse" aria-labelledby="headingM1Three" data-bs-parent="#addonAccordionM1">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/meja1/pijakankaki.png') }}" alt="Gantungan" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.pijakanKaki')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pintu -->


                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingM1Six">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseM1Six" aria-expanded="false" aria-controls="collapseM1Six">
                                                    Penutup Belakang Meja
                                                </button>
                                            </h2>
                                            <div id="collapseM1Six" class="accordion-collapse collapse" aria-labelledby="headingM1Six" data-bs-parent="#addonAccordionM1">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/meja1/penutup.png') }}" alt="Pintu 2" class="img-fluid shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.penutupBelakang')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


