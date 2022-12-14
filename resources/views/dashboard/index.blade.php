<x-layout>
    <x-search-barang />
    <h1 class="text-white mb-3">Koperasi Kejujuran</h1>

    <div id="listKategori" class="d-flex flex-wrap justify-content-start gap-3 mb-3"></div>

    <div class="d-flex justify-content-between align-items-start">
        <div id="listBarang" class="d-flex flex-wrap justify-content-center gap-3"></div>
        <x-informasi-barang></x-informasi-barang>
    </div>
    <x-modalBuy></x-modalBuy>
</x-layout>


<script>
    let barang = [];
    let kategori = [];
    let kategoriSelected = '';
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
                kategoriSelected = '';
                showListBarang();
            }
        })
    }

    function showInformasi(id) {
        $('#informasi-barang').show();
        $('#nama-barang').html(barang[id].nama_barang);
        $('#deskripsi-barang').html(barang[id].deskripsi);
        $('#stok').html("stok : " + barang[id].stok);
        $('#harga-barang').html("Rp" + barang[id].harga);
        $('#harga-barang').html("Rp" + barang[id].harga);
        if (barang[id].foto == null) {
            $('#foto-barang').attr('src',
                'https://static.wikia.nocookie.net/find-the-markers-roblox/images/5/5f/Placeholder.jpg/revision/latest?cb=20220313030844'
            );
        } else {
            $('#foto-barang').attr('src', `{{ asset('images/${barang[id].foto}') }}`);
        }
        $('#foto-barang').attr('alt', barang[id].nama_barang);
        $('#modalIdBarang').val(barang[id].id_barang);
    }

    function getBarangByKategori(idKategori) {
        const keyword = $('#keyword').val();
        kategoriSelected = idKategori;
        if (keyword !== "") {
            getBarangByKeyword();
        } else {
            if (kategoriSelected !== "") {
                $.ajax({
                    type: "GET",
                    url: `{{ url('/dashboard/getData/kategori/${idKategori}') }}`,
                    dataType: 'json',
                    success: function(res) {
                        barang = res.barang;
                        kategoriSelected = res.kategoriSelected;
                        showListBarang();
                    }
                })
            } else {
                getBarangByKeyword();
            }
        }
    }

    function showListBarang() {
        $('#informasi-barang').hide();

        // Show all category button
        let elementKategori = ``;
        elementKategori +=
            `<button class="btn ${kategoriSelected == '' ? 'btn-light' : 'btn-outline-light'}" onclick="getBarangByKategori('')">All</button>`;
        for (let i = 0; i < kategori.length; i++) {
            elementKategori +=
                `
            <button class="btn ${kategoriSelected == kategori[i].id_kategori ? 'btn-light' : 'btn-outline-light'}" onclick="getBarangByKategori(${kategori[i].id_kategori})">${kategori[i].nama_kategori}</button>
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
                    <img src="${item.foto ? `/images/${item.foto}` : 'https://static.wikia.nocookie.net/find-the-markers-roblox/images/5/5f/Placeholder.jpg/revision/latest?cb=20220313030844'}" class="card-img-top text-white" alt="${item.nama_barang}" height="250" style="object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0 text-white fw-bold">${item.nama_barang}</h5>
                        <br>
                        <small class="card-text text-secondary">Stok: ${item.stok}</small>
                        <br>
                        <small class="card-text text-secondary">Price: Rp${item.harga}</small>
                        <br><br>
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-warning" onclick="showInformasi(${i})">
                                Deskripsi Barang
                            </button>
                        </div>
                    </div>
                </div>
                `
        }
        $('#listBarang').html(elementBarang);
    }

    function getBarangByKeyword() {
        const keyword = $('#keyword').val();
        if (kategoriSelected) {
            if (keyword === '') {
                getBarangByKategori(kategoriSelected);
            } else {
                $.ajax({
                    type: "GET",
                    url: `{{ url('/dashboard/getData/kategori/${kategoriSelected}/keyword/${keyword}') }}`,
                    dataType: 'json',
                    success: function(res) {
                        barang = res.barang;
                        kategoriSelected = res.kategoriSelected;
                        showListBarang();
                    }
                })
            }
        } else {
            if (keyword === '') {
                loadData();
            } else {
                $.ajax({
                    type: "GET",
                    url: `{{ url('/dashboard/getData/keyword/${keyword}') }}`,
                    dataType: 'json',
                    success: function(res) {
                        barang = res.barang;
                        kategoriSelected = "";
                        showListBarang();
                    }
                })
            }
        }
    }
</script>
