
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{url('/')}}" class="app-brand-link">
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
      <a href="{{url('seller/')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard Toko </div>
      </a>
    </li>

    <!-- HOME MENU -->

    <!-- Master -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Toko</span>
    </li>
    <li class="menu-item {{request()->is('seller/produk/*') ? 'active open' : ''}}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="">Produk</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{request()->is('seller/produk/tambahProduk') ? 'active' : ''}}">
          <a href="{{url('/seller/produk/tambahProduk')}}" class="menu-link">
            <div >Tambah Produk</div>
          </a>
        </li>
        <li class="menu-item {{request()->is('seller/produk/daftarProduk') ? 'active' : ''}}">
          <a href="{{url('/seller/produk/daftarProduk')}}" class="menu-link">
            <div >Daftar Produk</div>
          </a>
        </li>


      </ul>
    </li>
    <li class="menu-item {{request()->is('seller/produkCustom*') ? 'active open' : ''}}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="">Produk Custom</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{request()->is('seller/produkCustom/tambahProdukCustom') ? 'active' : ''}}">
            <a href="{{url('/seller/produkCustom/tambahProdukCustom')}}" class="menu-link">
                <div >Tambah Produk Custom</div>
            </a>
        </li>
        <li class="menu-item {{request()->is('seller/produkCustom/daftarProdukCustom') ? 'active' : ''}}">
            <a href="{{url('/seller/produkCustom/daftarProdukCustom')}}" class="menu-link">
                <div >Daftar Produk Custom</div>
            </a>
        </li>
        <li class="menu-item {{request()->is('seller/produkCustom/templateProduk') ? 'active' : ''}}">
            <a href="{{url('/seller/produkCustom/templateProduk')}}" class="menu-link">
                <div >Template</div>
            </a>
        </li>
        <li class="menu-item {{request()->is('seller/produkCustom/addOn') ? 'active' : ''}}">
            <a href="{{url('/seller/produkCustom/addOn')}}" class="menu-link">
                <div >Add On</div>
            </a>
        </li>
        <li class="menu-item {{request()->is('seller/produkCustom/testing') ? 'active' : ''}}">
            <a href="{{url('/seller/produkCustom/testing')}}" class="menu-link">
                <div >Testing</div>
            </a>
        </li>



      </ul>
    </li>



    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Manajemen</span>
    </li>
    {{-- Master --}}
    <li class="menu-item {{request()->is('seller/master*') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Master</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{request()->is('seller/master/mebel') ? 'active' : ''}}">
                <a href="{{url('/seller/master/mebel')}}" class="menu-link">
                    <div >Mebel</div>
                </a>
            </li>
           
            <li class="menu-item {{request()->is('seller/master/Satuan') ? 'active' : ''}}">
                <a href="{{url('/seller/master/Satuan')}}" class="menu-link">
                  <div >Master Satuan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Master User</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/master/bahan') ? 'active' : ''}}">
                <a href="{{url('/seller/master/bahan')}}" class="menu-link ">
                  <div >Master Bahan</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/master/supplier') ? 'active' : ''}}">
                <a href="{{url('/seller/master/supplier')}}" class="menu-link">
                  <div >Master Supplier</div>
                </a>
            </li>



        </ul>
    </li>

    {{-- Produksi --}}
    <li class="menu-item {{request()->is('seller/produksi*') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Produksi</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{request()->is('seller/produksi/perencanaanProduksi') ? 'active' : ''}}">
                <a href="{{url('/seller/produksi/perencanaanProduksi')}}" class="menu-link ">
                    <div >Perencanaan Produksi</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/bom') ? 'active' : ''}}">
                <a href="{{url('/seller/produksi/bom')}}" class="menu-link">
                <div >Master Bill of Material</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/') ? 'active' : ''}}">
                <a href="{{url('/seller/produksi/tambahPenggunaanBahan')}}" class="menu-link">
                  <div >Penggunaan Bahan</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/') ? 'active' : ''}}">
                <a href="" class="menu-link">
                  <div >Pengembalian Bahan</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/') ? 'active' : ''}}">
                <a href="" class="menu-link">
                  <div >Laporan Produksi</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/') ? 'active' : ''}}">
                <a href="" class="menu-link">
                  <div >Laporan Penggunaan Bahan</div>
                </a>
            </li>
            <li class="menu-item {{request()->is('seller/produksi/') ? 'active' : ''}}">
                <a href="" class="menu-link">
                  <div >Laporan Gagal Produksi</div>
                </a>
            </li>


        </ul>
    </li>

    {{-- Gudang --}}
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Gudang</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="" class="menu-link">
                    <div >Master barang jadi</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                <div >Penerimaan Bahan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Penerimaan Barang</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Permintaan Pembeian</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Pengiriman</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Laporan Stok Bahan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="" class="menu-link">
                  <div >Laporan Retur</div>
                </a>
            </li>
            


        </ul>
    </li>



    {{-- <li class="menu-item">
        <a href="#" class="menu-link">
          <i class="menu-icon bx bx-info-circle"></i>
          <div data-i18n="Analytics">Info Layanan </div>
        </a>
    </li> --}}

</ul>

</aside>

