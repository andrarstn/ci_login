<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-9">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewMahasiswaModal">Add New Mahasiswa</a>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="hidden" name="getall" value="1">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari Mahasiswa...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="cari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row table-responsive">
        <div class="col-lg-9">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= form_error(
                'menu',
                '<div class="alert alert-danger" role="alert">',
                '</div>'
            ); ?>
            <?= $this->session->flashdata('message') ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    if ($mahasiswa) :
                        foreach ($mahasiswa as $m) : ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?= $m['nama'] ?></td>
                                <td><?= $m['nim'] ?></td>
                                <td><?= $m['jurusan'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>data/detailmahasiswa/<?= $m['id'] ?>" class="badge badge-success">Detail</a>
                                    <a href="<?= base_url() ?>data/editmahasiswa/<?= $m['id'] ?>" class="badge badge-warning">Edit</a>
                                    <a href="<?= base_url() ?>data/deletemahasiswa/<?= $m['id'] ?>" class="badge badge-danger btnDelete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger text-center" role="alert">
                                    Data mahasiswa is empty
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="NewMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>data/mahasiswa" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM Mahasiswa">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-3">
                        <label for="kelamin">kelamin</label>
                        <select class="form-control" id="kelamin" name="kelamin">
                            <option>Select kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan">
                            <option>Select jurusan</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['jurusan'] ?>"><?= $j['jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>