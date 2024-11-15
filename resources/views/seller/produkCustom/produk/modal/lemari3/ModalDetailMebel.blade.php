<div class="modal fade" id="modalLemari3" tabindex="-1" aria-labelledby="modalcek" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalceklabel">Detail Custom Lemari 3</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center text-primary border-bottom pb-2">Lemari 3</h2>
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
                                    <h4 class="mb-0">Foto</h4>
                                </div>
                                <div class="card-body product-gallery">
                                    <div id="image-lemari3" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active image-container">
                                                <img src="{{ asset('img/lemari3/lemari3.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 1">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari3/lemari3samping.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 2">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari3/lemari3belakang.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 3">
                                            </div>
                                            <div class="carousel-item image-container">
                                                <img src="{{ asset('img/lemari3/lemari3bawah.png') }}" class="d-block mx-auto" style="height: 400px; object-fit: contain;" alt="Template 3">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#image-lemari3" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#image-lemari3" data-bs-slide="next">
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
                                    <div class="accordion" id="addonAccordionL3">
                                        <!-- Sekat Vertical -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL3One">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3One" aria-expanded="false" aria-controls="collapseL3One">
                                                    Sekat Vertical
                                                </button>
                                            </h2>
                                            <div id="collapseL3One" class="accordion-collapse collapse" aria-labelledby="headingL3One" data-bs-parent="#addonAccordionL3">
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
                                            <h2 class="accordion-header" id="headingL3Two">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3Two" aria-expanded="false" aria-controls="collapseL3Two">
                                                    Sekat Horizontal
                                                </button>
                                            </h2>
                                            <div id="collapseL3Two" class="accordion-collapse collapse" aria-labelledby="headingL3Two" data-bs-parent="#addonAccordionL3">
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
                                            <h2 class="accordion-header" id="headingL3Three">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3Three" aria-expanded="false" aria-controls="collapseL3Three">
                                                    Gantungan
                                                </button>
                                            </h2>
                                            <div id="collapseL3Three" class="accordion-collapse collapse" aria-labelledby="headingL3Three" data-bs-parent="#addonAccordionL3">
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
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL1Seven">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL1Seven" aria-expanded="false" aria-controls="collapseL1Seven">
                                                    Laci Kecil
                                                </button>
                                            </h2>
                                            <div id="collapseL1Seven" class="accordion-collapse collapse" aria-labelledby="headingL1Seven" data-bs-parent="#addonAccordion">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/lemari2/lacikecil.png') }}" alt="Gantungan" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.laciKecil')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL1Eight">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL1Eight" aria-expanded="false" aria-controls="collapseL1Eight">
                                                    Laci Besar
                                                </button>
                                            </h2>
                                            <div id="collapseL1Eight" class="accordion-collapse collapse" aria-labelledby="headingL1Eight" data-bs-parent="#addonAccordion">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <img src="{{ asset('img/lemari2/lacibesar.png') }}" alt="Gantungan" class="img-fluid  shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddOn.laciBesar')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pintu -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL3Four">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3Four" aria-expanded="false" aria-controls="collapseL3Four">
                                                    Pintu 1
                                                </button>
                                            </h2>
                                            <div id="collapseL3Four" class="accordion-collapse collapse" aria-labelledby="headingL3Four" data-bs-parent="#addonAccordionL3">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari3/pintu.png') }}" alt="Pintu 1" class="img-fluid shadow-sm" style="max-height: 400px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.lemari1.pintu1')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL3Five">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3Five" aria-expanded="false" aria-controls="collapseL3Five">
                                                    Pintu 2
                                                </button>
                                            </h2>
                                            <div id="collapseL3Five" class="accordion-collapse collapse" aria-labelledby="headingL3Five" data-bs-parent="#addonAccordionL3">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari3/pintu2.jpeg') }}" alt="Pintu 2" class="img-fluid shadow-sm" style="max-height: 200px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                            @include('seller.produkCustom.penjelasanAddon.lemari1.pintu2')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingL3Six">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL3Six" aria-expanded="false" aria-controls="collapseL3Six">
                                                    Pintu 3 (Pintu Geser)
                                                </button>
                                            </h2>
                                            <div id="collapseL3Six" class="accordion-collapse collapse" aria-labelledby="headingL3Six" data-bs-parent="#addonAccordionL3">
                                                <div class="accordion-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 text-center">
                                                            <img src="{{ asset('img/lemari3/pintugeser.jpg') }}" alt="Pintu 2" class="img-fluid shadow-sm" style="max-height: 200px;">
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


