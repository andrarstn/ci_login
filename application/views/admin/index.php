<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <h3>Users</h3>
    <div class="row">
        <div class="col-sm-9 col-lg">
            <div class="row row-cols-1 row-cols-md-2">
                <?php
                foreach ($users as $s) : ?>
                    <div class="col mb-4">
                        <div class="card" style="width: 300px">
                            <img src="<?= base_url() ?>assets/img/<?= $s['image'] ?>" class="card-img-top d-none d-sm-block" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $s['name'] ?></h5>
                                <p>Email: <?= $s['email'] ?></p>
                                <a href="<?= base_url() ?>admin/mahasiswadetail/<?= $s['id'] ?>" class="badge badge-info">Mahasiswa</a>
                                <a href="<?= base_url() ?>admin/filedetail/<?= $s['id'] ?>" class="badge badge-info">Files</a>
                                <a href="<?= base_url() ?>admin/delete/<?= $s['id'] ?>" class="badge badge-danger btnDelete">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->