<x-layout>
    <div id="listKategori" class="d-flex flex-wrap justify-content-center gap-3 "></div>
        
    <div class="d-flex justify-content-between">
        <div id="listBarang" class="d-flex flex-wrap justify-content-center gap-3"></div>
        <x-informasi-barang></x-informasi-barang>
    </div>
</x-layout>


<script>
    let barang = [];
    let kategori = [];
    $(document).ready(function() {
        loadData();
    });

    function loadData() {
        $.ajax({
            type: "GET",
            url: "{{ url('/dashboard/getData') }}",
            dataType: 'json',
            success: function(res) {
                barang = res.barang;
                kategori = res.kategori;
                showListBarang();
            }
        })
    }

    function confirmBeli(id_barang) {
        $('#confirmBeli').show()
    }

    function showInformasi(id) {
        $('#informasi-barang').show();
        $('#nama-barang').html(barang[id].nama_barang);
        $('#deskripsi-barang').html(barang[id].deskripsi);
        $('#stok').html("stok : " + barang[id].stok);
        $('#harga-barang').html("Rp"+barang[id].harga);
        $('#foto-barang').attr('src', `{{ asset('images/${barang[id].foto}') }}`);
        $('#foto-barang').attr('alt', barang[id].nama_barang);
    }

    function showListBarang() {
        // console.log(res);
        // Show all category button
        let elementKategori = ``;
        for (let i = 0; i < kategori.length; i++) {
            elementKategori += 
            `
            <button onclick="filterByKategori(${kategori[i].id_kategori})">${kategori[i].nama_kategori}</button>
            `
        }
        
        $('#listKategori').html(elementKategori);
        

        // Show all barang yang bisa dibeli
        let elementBarang = ``;
        for (let i = 0; i < barang.length; i++) {
            const item = barang[i];
            elementBarang += 
                `
                <div class="card bg-dark border-light" style="width: 18rem;">
                    <img src="/images/${item.foto}" class="card-img-top text-white" alt="${item.nama_barang}" height="250" style="object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0 text-white fw-bold">${item.nama_barang}</h5>
                        <br>
                        <small class="card-text text-secondary">Stok: ${item.stok}</small>
                        <br>
                        <small class="card-text text-secondary">Price: Rp${item.harga}</small>
                        <br><br>
                        <div class="d-flex flex-wrap gap-3">
                            <button onclick="showInformasi(${i})">
                                Deskripsi Barang
                            </button>
                        </div>
                    </div>
                </div>
                `
        }
        $('#listBarang').html(elementBarang);
    }
</script>
