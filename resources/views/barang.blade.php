<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- show table from table barang --}}
    <?php
    $db = mysqli_connect("localhost", "root", "", "koperasi_kejujuran");
    $query = "SELECT * FROM barang b, kategori k WHERE b.id_kategori = k.id_kategori";
    $result = $db->query($query);
    if (!$result) {
        die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
    }
    ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @while ($row = $result->fetch_object())
            <tr>
                <td>{{$row->id_barang}}</td>
                <td>{{$row->nama_barang}}</td>
                <td>{{$row->harga}}</td>
                <td>{{$row->stok}}</td>
                <td>{{$row->nama_kategori}}</td>
            </tr> 
            @endwhile
        </tbody>
</body>
</html>