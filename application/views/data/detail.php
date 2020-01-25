<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header text-center text-muted"><?= $title ?></h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $mahasiswa['nama'] ?></h5>
                    <form action="">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $mahasiswa['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">NIM</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $mahasiswa['nim'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $mahasiswa['kelamin'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Jurusan</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $mahasiswa['jurusan'] ?>">
                            </div>
                        </div>
                    </form>
                    <?php if ($user['role_id'] == 1) : ?>
                        <a href="<?= base_url() ?>admin/mahasiswadetail/<?= $mahasiswa['id_user'] ?>" class="btn btn-primary">Back</a>
                    <?php else : ?>
                        <a href="<?= base_url() ?>data/mahasiswa" class="btn btn-primary">Back</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>