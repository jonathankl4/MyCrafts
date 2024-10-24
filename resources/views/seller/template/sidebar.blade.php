<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- <img src="img/icons/brands/ubs.png" alt class="w-px-40"> --}}
            </span>


            <span class="menu-text fw-bolder ms-2 px-15">MyCraft</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>


    <ul class="menu-inner py-1">



        <!-- Dashboard -->


        <li class="menu-item {{ request()->is('seller') ? 'active open' : '' }} ">
            <a href="{{ url('seller/') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard Toko </div>
            </a>

        </li>

        @if ($user->status == 'owner')
            <li class="menu-item {{ request()->is('seller/membership') ? 'active open' : '' }} ">
                <a href="{{ url('seller/membership') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-lock-open"></i>
                    <div data-i18n="Analytics">Membership </div>
                </a>

            </li>
        @endif

        <!-- HOME MENU -->

        @if ($user->status == 'pegawai-penjualan' || $user->status == 'owner')
            <!-- TOko -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Toko</span>
            </li>
            <li class="menu-item {{ request()->is('seller/produk/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="">Produk</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('seller/produk/tambahProduk') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produk/tambahProduk') }}" class="menu-link">
                            <div>Tambah Produk</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produk/daftarProduk') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produk/daftarProduk') }}" class="menu-link">
                            <div>Daftar Produk</div>
                        </a>
                    </li>


                </ul>
            </li>
            <li class="menu-item {{ request()->is('seller/produkCustom*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="">Produk Custom</div>
                </a>
                <ul class="menu-sub">
                    <li
                        class="menu-item {{ request()->is('seller/produkCustom/tambahProdukCustom') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produkCustom/tambahProdukCustom') }}" class="menu-link">
                            <div>Tambah Produk Custom</div>
                        </a>
                    </li>
                    <li
                        class="menu-item {{ request()->is('seller/produkCustom/daftarProdukCustom') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produkCustom/daftarProdukCustom') }}" class="menu-link">
                            <div>Daftar Produk Custom</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('seller/produkCustom/testing') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produkCustom/testing') }}" class="menu-link">
                            <div>Contoh Custom</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produkCustom/informasi') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produkCustom/informasi') }}" class="menu-link">
                            <div>Informasi</div>
                        </a>
                    </li>



                </ul>
            </li>
            <li class="menu-item {{ request()->is('seller/pesanan') ? 'active open' : '' }}">
                <a href="{{ url('/seller/pesanan') }}" class="menu-link ">
                    <i class="menu-icon tf-icons bx bxs-food-menu"></i>
                    <div>Pesanan</div>
                </a>

            </li>
        @endif
        @if ($user->status == 'owner')
            <li class="menu-item {{ request()->is('seller/pegawai') ? 'active open' : '' }}">
                <a href="{{ url('/seller/pegawai') }}" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Pegawai</div>
                </a>

            </li>
        @endif


        @if ($user->status == 'owner' || $user->status == 'pegawai-produksi' || $user->status == 'pegawai-gudang')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Manajemen</span>
            </li>
            {{-- Master --}}

            <li class="menu-item {{ request()->is('seller/master*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings"
                        style="display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;">
                        Master <span class="badge" style="background-color: #898063">Pro</span></div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('seller/master/mebel') ? 'active' : '' }}">
                        <a href="{{ url('/seller/master/mebel') }}" class="menu-link">
                            <div>Mebel</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('seller/master/bahan') ? 'active' : '' }}">
                        <a href="{{ url('/seller/master/bahan') }}" class="menu-link ">
                            <div>Master Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/master/supplier') ? 'active' : '' }}">
                        <a href="{{ url('/seller/master/supplier') }}" class="menu-link">
                            <div>Master Supplier</div>
                        </a>
                    </li>



                </ul>
            </li>
        @endif

        {{-- Produksi --}}
        @if ($user->status == 'owner' || $user->status == 'pegawai-produksi')
            <li class="menu-item {{ request()->is('seller/produksi*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-briefcase"></i>
                    <div data-i18n="Account Settings"
                        style="display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;">
                        Produksi <span class="badge " style="background-color: #898063">Pro</span></div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('seller/produksi/perencanaanProduksi') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produksi/perencanaanProduksi') }}" class="menu-link ">
                            <div>Perencanaan Produksi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/bom') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produksi/bom') }}" class="menu-link">
                            <div>Master Bill of Material</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/') ? 'active' : '' }}">
                        <a href="{{ url('/seller/produksi/tambahPenggunaanBahan') }}" class="menu-link">
                            <div>Penggunaan Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/') ? 'active' : '' }}">
                        <a href="" class="menu-link">
                            <div>Pengembalian Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/') ? 'active' : '' }}">
                        <a href="" class="menu-link">
                            <div>Laporan Produksi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/') ? 'active' : '' }}">
                        <a href="" class="menu-link">
                            <div>Laporan Penggunaan Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('seller/produksi/') ? 'active' : '' }}">
                        <a href="" class="menu-link">
                            <div>Laporan Gagal Produksi</div>
                        </a>
                    </li>


                </ul>
            </li>
        @endif

        {{-- Gudang --}}
        @if ($user->status == 'owner' || $user->status == 'pegawai-gudang')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxl-dropbox"></i>
                    <div data-i18n="Account Settings"
                        style="display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;">
                        Gudang <span class="badge " style="background-color: #898063">Pro</span></div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Master barang jadi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Penerimaan Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Penerimaan Barang</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Permintaan Pembeian</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Pengiriman</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Laporan Stok Bahan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div>Laporan Retur</div>
                        </a>
                    </li>



                </ul>
            </li>
        @endif

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Lain-lain</span>
        </li>


        <li class="menu-item {{ request()->is('seller/Satuan') ? 'active' : '' }}">
            <a href="{{ url('/seller/Satuan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-ruler"></i>
                <div>Master Satuan</div>
            </a>
        </li>




        {{-- <li class="menu-item">
        <a href="#" class="menu-link">
          <i class="menu-icon bx bx-info-circle"></i>
          <div data-i18n="Analytics">Info Layanan </div>
        </a>
    </li> --}}

    </ul>

</aside>
