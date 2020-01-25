<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url() ?>user/changepassword" method="post">
                <div class="form-group">
                    <label for="current_password">Password</label>
                    <input type="password" class="form-control pw" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>') ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" onclick="hideShowPw1();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password1">Password</label>
                    <input type="password" class="form-control pw2" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>') ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" onclick="hideShowPw2();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password2">Repeat Password</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->