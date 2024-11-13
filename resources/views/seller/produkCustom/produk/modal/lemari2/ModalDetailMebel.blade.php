<div class="modal fade" id="modalLemari2" tabindex="-1" aria-labelledby="modalcek" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalceklabel">Detail Custom Lemari 2</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center text-primary border-bottom pb-2">Lemari 2</h2>
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
                                            Lebar: 80cm - 120cm
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-arrows-angle-expand me-2"></i>
                                            Tinggi: 170cm -200 cm
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-arrows-angle-expand me-2"></i>
                                            Kedalaman: 45cm - 60cm
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
                                    <h4 class="mb-0">Template Lemari</h4>
                                </div>
                                <div class="card-body product-ga">
                                    <div id="image-lemari2" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active image-container">
                                                <img src="{{ asset('img/lemari2/lemari2.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 1">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari2/lemari2samping.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 2">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari2/lemari2belakang.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 3">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari2/lemari2bawah.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 3">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#image-lemari2" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#image-lemari2" data-bs-slide="next">
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
                                    <div class="accordion" id="addonAccordionL2">
                                        <!-- Sekat Vertical -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2One">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2One" aria-expanded="false" aria-controls="collapseL2One">
                                                    Sekat Vertical
                                                </button>
                                            </h2>
                                            <div id="collapseL2One" class="accordion-collapse collapse" aria-labelledby="headingL2One" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/sekatVertical.jpeg') }}" alt="Sekat Vertical" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.sekatVertical')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sekat Horizontal -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2Two">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2Two" aria-expanded="false" aria-controls="collapseL2Two">
                                                    Sekat Horizontal
                                                </button>
                                            </h2>
                                            <div id="collapseL2Two" class="accordion-collapse collapse" aria-labelledby="headingL2Two" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/sekatHorizontal.jpeg') }}" alt="Sekat Horizontal" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.sekatHorizontal')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gantungan -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2Three">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2Three" aria-expanded="false" aria-controls="collapseL2Three">
                                                    Gantungan
                                                </button>
                                            </h2>
                                            <div id="collapseL2Three" class="accordion-collapse collapse" aria-labelledby="headingL2Three" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/gantungan.jpeg') }}" alt="Gantungan" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.gantungan')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pintu -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2Four">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2Four" aria-expanded="false" aria-controls="collapseL2Four">
                                                    Pintu 1
                                                </button>
                                            </h2>
                                            <div id="collapseL2Four" class="accordion-collapse collapse" aria-labelledby="headingL2Four" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari2/pintu1.png') }}" alt="Pintu 1" class="img-fluid shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.lemari1.pintu1')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2Five">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2Five" aria-expanded="false" aria-controls="collapseL2Five">
                                                    Pintu 2
                                                </button>
                                            </h2>
                                            <div id="collapseL2Five" class="accordion-collapse collapse" aria-labelledby="headingL2Five" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari2/pintu2.jpeg') }}" alt="Pintu 2" class="img-fluid shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.lemari1.pintu2')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL2Six">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2Six" aria-expanded="false" aria-controls="collapseL2Six">
                                                    Pintu 3 (Pintu Geser)
                                                </button>
                                            </h2>
                                            <div id="collapseL2Six" class="accordion-collapse collapse" aria-labelledby="headingL2Six" data-bs-parent="#addonAccordionL2">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari2/pintugeser.jpg') }}" alt="Pintu 2" class="img-fluid shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.pintugeser')
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


