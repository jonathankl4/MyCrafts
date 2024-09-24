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
        <li class="menu-item">
            <a href="{{ url('masteruser/') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard Toko </div>
            </a>
        </li>

        <!-- HOME MENU -->

        <!-- Master -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Toko</span>
        </li>
        <li class="menu-item {{ request()->is('masteruser/produk/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="">Produk</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('masteruser/produk/tambahProduk') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produk/tambahProduk') }}" class="menu-link">
                        <div>Tambah Produk</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produk/daftarProduk') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produk/daftarProduk') }}" class="menu-link">
                        <div>Daftar Produk</div>
                    </a>
                </li>


            </ul>
        </li>
        <li class="menu-item {{ request()->is('masteruser/produkCustom*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="">Produk Custom</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('masteruser/produkCustom/tambahProdukCustom') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/tambahProdukCustom') }}" class="menu-link">
                        <div>Tambah Produk Custom</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('masteruser/produkCustom/daftarProdukCustom') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/daftarProdukCustom') }}" class="menu-link">
                        <div>Daftar Produk Custom</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/templateProduk') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/templateProduk') }}" class="menu-link">
                        <div>Template</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/addOn') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/addOn') }}" class="menu-link">
                        <div>Add On</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/testing') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/lemari1') }}" class="menu-link">
                        <div>Lemari 1</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/testing') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/lemari2') }}" class="menu-link">
                        <div>Lemari 2</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/testing') ? 'active' : '' }}">
                    <a href="{{ url('/masteruser/produkCustom/lemari3') }}" class="menu-link">
                        <div>Lemari 3</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('masteruser/produkCustom/testing') ? 'active' : '' }}">
                  <a href="{{ url('/masteruser/produkCustom/meja1') }}" class="menu-link">
                      <div>meja 1</div>
                  </a>
              </li>



            </ul>
        </li>





        {{-- Produksi --}}


        {{-- Gudang --}}




        {{-- <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon bx bx-info-circle"></i>
        <div data-i18n="Analytics">Info Layanan </div>
      </a>
  </li> --}}

    </ul>

</aside>
