<div id="informasi-barang" style="display: none; width:450px;" class="bg-dark p-2 card">
    <h3>Deskripsi Barang</h3>
    <img src="" id="foto-barang" class="text-white" alt="" height="250" style="object-fit:contain;">
    <h2 id="nama-barang" class=""></h2>
    <p id="deskripsi-barang"></p>
    <div id="stok" class="text-secondary"></div>
    <h2 id="harga-barang"></h2>
    <button type="button" onclick="showBuy()" class="btn btn-warning text-white" id="beli"><i class="fa-solid fa-cart-shopping me-1 fs-4"></i> Checkout</button>
</div>

<script>
    function showBuy() {
        $('#harga').val('');
        $('#kuantitas').val('');
        $('#modalIdBarang').val('');
        $('#modalBuy').modal('show');
        $('#modalFotoBarang').attr('src', $('#foto-barang').attr('src'));
        $('#modalNamaBarang').text($('#nama-barang').text());
        $('#modalHargaBarang').text($('#harga-barang').text());
        $('#modalBuyTitle').html('Checkout');
        $('#modalStokBarang').text($('#stok').text());
        $('#submitBuyButton').html('Beli');
    }
</script>
