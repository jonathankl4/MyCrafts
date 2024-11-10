<form id="redesain-form">
    <div>
        <label for="harga-fix">Harga Fix Untuk Desain Lama</label>
        <input type="number" id="harga-fix" name="harga-fix" class="form-control" required>
    </div>
    <div>
        <label for="harga-redesain">Harga Fix Untuk Desain Baru </label>
        <input type="number" name="harga-redesain" id="harga-redesain" required
            class="form-control">
    </div>
    <div>
        <label for="harga-redesain">Ongkir </label>
        <input type="number" name="ongkir" id="ongkir" required
            class="form-control">
    </div>
    <br>



    {{-- <a href="#" id="redesain" class="btn btn-primary">Kirim Desain Baru</a> --}}
    <button type="button" id="terimaPesanan" class="btn btn-primary">Terima, Kirim Desain Baru</button>

</form>



