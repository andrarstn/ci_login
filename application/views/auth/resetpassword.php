<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">Reset Password</h1>
                                    <h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h5>
                                </div>
                                <?= $this->session->flashdata('message') ?>
                                <form class="user" action="<?= base_url() ?>auth/resetpassword" method="post">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user pw" id="password1" name="password1" placeholder="Enter New Password...">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" onclick="hideShowPw1();">
                                            <small><label class="form-check-label" for="exampleCheck1">Show Password</label></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user pw2" id="password2" name="password2" placeholder="Repeat Your New Password...">
                                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" onclick="hideShowPw2();">
                                            <small>
                                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                                            </small>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>