<?php

require_once('classes/Mahasiswa.php');

$mhs = new Mahasiswa();
$data = $mhs->show();

if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $editData = $mhs->getByNim($nim);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $nim = $_POST['nim'];
        $mhs->edit($nim, $_POST);
        header("Location: index.php");
    } else {
        $mhs->add($_POST);
        header("Location: index.php");
    }
}

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $mhs->destroy($nim);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-3 mt-5">
        <table class="table table stripped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $user) { ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $user['nim'] ?></td>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['gender'] ?></td>
                    <td>
                        <a href="index.php?edit=<?= $user['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?nim=<?= $user['nim'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>

    <div class="container mt-5 mb-3">
        <div class="card p-4 mx-auto" style="width: 28rem;">
            <h2 class="text-center">Form Mahasiswa</h2>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                        value="<?= isset($editData) ? $editData['nim'] : '' ?>"
                        <?= isset($editData) ? 'readonly' : '' ?>>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="<?= isset($editData) ? $editData['nama'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= isset($editData) ? $editData['email'] : '' ?>">
                </div>
                <div class="mb-3">
                    <div class="mb-2">Gender</div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="laki" name="gender" value="L"
                            <?= isset($editData) && $editData['gender'] == 'L' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="laki">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="perempuan" name="gender" value="P"
                            <?= isset($editData) && $editData['gender'] == 'P' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
                <button type="submit" name="<?= isset($editData) ? 'update' : '' ?>"
                    class="btn btn-primary"><?= isset($editData) ? 'Update' : 'Submit' ?></button>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>