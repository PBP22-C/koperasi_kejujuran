<x-layout>
    <div class="container row">
        <div class="col-6">

            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
        </div>
        <div class="col-6 my-auto">

            <i class="fa-solid fa-bell col-6"></i>
        </div>
    </div>
    <div class="container my-5">
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4 bg">
            <h1 class="text-white fs-3">List Barang</h1>
            <button onclick="showTambah()" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#tambahBarang">
                Tambah Barang
            </button>
        </div>
        <div id="listBarang" class="d-flex flex-wrap gap-3">

        </div>
    </div>

    <x-modal>
        @foreach ($kategori as $item)
            <option value="{{ $item->id_kategori }}">
                {{ $item->nama_kategori }}
            </option>
        @endforeach
    </x-modal>
</x-layout>

{{-- AJAX --}}
<script>
    $(document).ready(function() {
        showBarang();
    });
    const modalBarang = document.getElementById('modalBarang');

    function showEdit(id) {
        $.ajax({
            type: "GET",
            url: `{{ url('/barang/edit/${id}') }}`,
            dataType: 'json',
            success: function(res) {
                console.log(res.data);
                const barang = res.data;
                $('#modalBarang').modal('show');
                $('#modalTitle').html('Edit Barang');
                $('#id_barang').val(barang.id_barang);
                $('#nama_barang').val(barang.nama_barang);
                $('#deskripsi').val(barang.deskripsi);
                $('#id_kategori').val(barang.id_kategori);
                $('#harga').val(barang.harga);
                $('#stok').val(barang.stok);
                $('#foto').attr('src', `{{ asset('images/${barang.foto}') }}`);
                $('#foto').attr('alt', barang.nama_barang);
                $('#submitButton').html('Ubah Data');
            }
        });
    }

    function showTambah() {
        resetModal();
        $('#modalBarang').modal('show');
        $('#modalTitle').html('Tambah Barang');
        $('#submitButton').html('Tambah Data');
    }

    $("#formBarang").on('submit', function(e) {
        e.preventDefault();
        $('#submitButton').html('Loading...');
        $('#submitButton').attr('disabled', true);
        const form = new FormData(this);
        form.append('id_barang', $('#id_barang').val());
        form.append('nama_barang', $('#nama_barang').val());
        form.append('deskripsi', $('#deskripsi').val());
        form.append('id_kategori', $('#id_kategori').val());
        form.append('harga', $('#harga').val());
        form.append('stok', $('#stok').val());
        if ($('#foto').val() != '') {
            form.append('foto', $('#foto')[0].files[0]);
        }
        const url = $("#id_barang").val() ? `{{ url('/barang/update') }}` : `{{ url('/barang/store') }}`;
        $.ajax({
            type: "POST",
            url: url,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            data: form,
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $('#modalBarang').modal('hide');
                resetModal();
                showBarang();
            },
            error: function(err) {
                console.log(err);
                $('#submitButton').html('Tambah Data');
                $('#submitButton').attr('disabled', false);
                $('#errorField').html(err.responseJSON.message);
            }
        });
    });

    function showBarang() {
        $.ajax({
            type: "GET",
            url: "{{ url('/barang') }}",
            dataType: 'json',
            success: function(res) {
                console.log(res.data);
                const barang = res.data;
                let result = ``;
                for (let i = 0; i < barang.length; i++) {
                    const item = barang[i];
                    result +=
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
                                    <button onclick="showEdit(${item.id_barang})" type="button" class="btn btn-warning text-white">
                                        Edit Barang
                                    </button>
                                    <button type="button" onclick="deleteBarang(${item.id_barang})" class="btn btn-outline-danger text-white">Hapus
                                        Barang</button>
                                </div>
                            </div>
                        </div>
                        `
                }
                $('#listBarang').html(result);
            }
        });
    }

    function deleteBarang(id) {
        if (confirm('Apakah anda yakin ingin menghapus barang ini?')) {
            $.ajax({
                type: "GET",
                url: `{{ url('/barang/delete/${id}') }}`,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    showBarang();
                }
            });
        }
    }

    function resetModal() {
        $('#modalTitle').html('');
        $('#submitButton').html('');
        $('#submitButton').attr('disabled', false);
        $('#id_barang').val('');
        $('#nama_barang').val('');
        $('#deskripsi').val('');
        $('#harga').val('');
        $('#stok').val('');
        $('#foto').src = '';
        $('#foto').alt = '';
        $('#formFile').replaceWith($('#formFile').val('').clone(true));
        $('#id_kategori').val('');
    }
</script>
