<div id="informasi-barang" style="display: none; width:450px;" class="bg-dark p-2 card">
    <h3>Deskripsi Barang</h3>
    <img src="" id="foto-barang" class="text-white" alt="" height="250" style="object-fit:contain;">
    <h2 id="nama-barang" class=""></h2>
    <p id="deskripsi-barang"></p>
    <div id="stok" class="text-secondary"></div>
    <h2 id="harga-barang"></h2>

    <form action="/dashboard/buy" id="buyProduct">
        <input type="hidden" name="id_barang" id="id_barang">
        <input type="number" name="harga" id="harga" min="1">
        <input type="number" name="kuantitas" id="kuantitas" min="1">
        <button type="submit" id="beli">Beli</button>
    </form>
</div>

<script>
    $('#buyProduct').on('submit', function(e) {
        e.preventDefault();
        const harga_total = $('#harga').val();
        const kuantitas = $('#kuantitas').val();
        const id_barang = $('#id_barang').val();
        const url = `{{ url('/dashboard/buy') }}`;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                harga_total: harga_total,
                kuantitas: kuantitas,
                id_barang: id_barang
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                showBarang();
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>
