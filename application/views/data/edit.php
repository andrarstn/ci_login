<div class="container">
    <div class="row">
        <div class="col">
            <h3><?= $title ?></h3>
            <form action="<?= base_url() ?>data/editmahasiswa/<?= $mahasiswa['id'] ?>" method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" value="<?= $mahasiswa['nama'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="<?= $mahasiswa['nim'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" value="<?= $mahasiswa['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="kelamin">kelamin</label>
                    <select class="form-control" id="kelamin" name="kelamin">
                        <option>Select kelamin</option>
                        <?php foreach ($kelamin as $k) :
                            if ($k['kelamin'] == $mahasiswa['kelamin']) : ?>
                                <option value="<?= $k['kelamin'] ?>" selected><?= $k['kelamin'] ?></option>
                            <?php else : ?>
                                <option value="<?= $k['kelamin'] ?>"><?= $k['kelamin'] ?></option>
                        <?php endif;
                        endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" id="jurusan" name="jurusan">
                        <option>Select jurusan</option>
                        <?php foreach ($jurusan as $j) : ?>
                            <?php if ($j['jurusan'] == $mahasiswa['jurusan']) : ?>
                                <option value="<?= $j['jurusan'] ?>" selected><?= $j['jurusan'] ?></option>
                            <?php else : ?>
                                <option value="<?= $j['jurusan'] ?>"><?= $j['jurusan'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <a href="<?= base_url() ?>data/mahasiswa" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>