@extends('template.MasterDesain')

@section('title', 'Dashboard')

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

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 1cm ">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Buat Permintaan Pembelian</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/seller/gudang/buatPermintaanPembelian')}}" method="POST" id="formPermintaan">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" id="tambahItem">
                                    + Tambah Item
                                </button>
                            </div>
                        </div>

                        <div id="itemContainer">
                            <!-- Item rows will be added here -->
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Simpan Permintaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Template for new item row -->
        <template id="itemTemplate">
            <div class="row mb-3 item-row">
                <div class="col-md-3">
                    <select name="items[INDEX][nama_barang]" class="form-control bahan-select" required>
                        <option value="">Pilih Bahan</option>
                        @foreach($bahans as $bahan)
                            <option value="{{ $bahan->nama_bahan }}"
                                    data-harga="{{ $bahan->harga_bahan }}"
                                    data-satuan="{{ $bahan->satuan_bahan }}">
                                {{ $bahan->nama_bahan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="items[INDEX][jumlah]" class="form-control jumlah"
                           placeholder="Jumlah" required min="1">
                </div>
                <div class="col-md-2">
                    <input type="text" name="items[INDEX][satuan]" class="form-control satuan"
                           placeholder="Satuan" readonly>
                </div>
                <div class="col-md-2">
                    <input type="number" name="items[INDEX][harga]" class="form-control harga"
                           placeholder="Harga" readonly>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control total-harga" placeholder="Total" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger hapus-item">X</button>
                </div>
            </div>
        </template>






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
    document.addEventListener('DOMContentLoaded', function() {
        let itemIndex = 0;
        const container = document.getElementById('itemContainer');
        const template = document.getElementById('itemTemplate');

        // Add new item row
        document.getElementById('tambahItem').addEventListener('click', function() {
            const newRow = template.content.cloneNode(true);

            // Update index in name attributes
            newRow.querySelectorAll('[name*="INDEX"]').forEach(element => {
                element.name = element.name.replace('INDEX', itemIndex);
            });

            // Add event listeners for the new row
            addRowEventListeners(newRow);

            container.appendChild(newRow);
            itemIndex++;
        });

        // Delete item row
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-item')) {
                e.target.closest('.item-row').remove();
            }
        });

        function addRowEventListeners(row) {
            const bahanSelect = row.querySelector('.bahan-select');
            const jumlahInput = row.querySelector('.jumlah');
            const satuanInput = row.querySelector('.satuan');
            const hargaInput = row.querySelector('.harga');
            const totalHargaInput = row.querySelector('.total-harga');

            bahanSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                hargaInput.value = selected.dataset.harga || '';
                satuanInput.value = selected.dataset.satuan || '';
                hitungTotal();
            });

            jumlahInput.addEventListener('input', hitungTotal);

            function hitungTotal() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                totalHargaInput.value = (jumlah * harga).toLocaleString('id-ID');
            }
        }

        // Add first row automatically
        document.getElementById('tambahItem').click();
    });
    </script>

@endsection


