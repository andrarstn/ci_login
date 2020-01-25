<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800"><?= $title ?></h1>
    <a href="<?= base_url() ?>admin" class="btn btn-info mb-2">Back</a>
    <div class="row table-responsive">
        <div class="col-lg-9">
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