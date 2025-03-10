<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request dengan input laravel</title>
</head>
<body>
    <form action="/formulir/proses" method="post">
        @csrf
        Nama : <input type="text" name="nama"><br>
        Alamat : <input type="text" name="alamat">
        <input type="submit" value="Simpan">
    </form>
</body>
</html>