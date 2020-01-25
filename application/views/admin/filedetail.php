<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-9">
            <a href="<?= base_url() ?>admin" class="btn btn-info mb-2">Back</a>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="hidden" name="getall" value="1">
                    <input type="text" class="form-control" name="keyword" placeholder="Search file...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="cari">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row table-responsive">
        <div class="col-lg-10">
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
                        <th scope="col">File Name</th>
                        <th scope="col">Extensions</th>
                        <th scope="col">Size</th>
                        <th scope="col">Uploaded</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    $total = 0;
                    $now = time();
                    if ($files) :
                        foreach ($files as $f) : ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <?php if (strlen($f['name']) > 35) : ?>
                                    <td><?= substr($f['name'], 0, 35) . '...' ?></td>
                                <?php else : ?>
                                    <td><?= $f['name'] ?></td>
                                <?php endif; ?>
                                <td><?= $f['extension'] ?></td>
                                <td><?= convertSize($f['size']) ?></td>
                                <td><?= convertDate($f['date'])  ?></td>
                                <td>
                                    <a href="<?= base_url() ?>file/download/<?= $f['name'] ?>" class="badge badge-success">Download</a>
                                    <a href="<?= base_url() ?>file/delete/<?= $f['name'] ?>" class="badge badge-danger btnDelete">Delete</a>
                                </td>
                            </tr>
                        <?php $total = $total + $f['size'];
                        endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-warning text-center" role="alert">
                                    Files is empty. Let's upload some files.
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

<?php
function convertSize($size, $precision = 2)
{
    $kilobyte = 1000;
    $megabyte = $kilobyte * 1000;
    $gigabyte = $megabyte * 1000;
    $terabyte = $gigabyte * 1000;
    if ($size >= 0 && $size < $kilobyte) {
        return $size . ' KB';
    } else if (($size >= $kilobyte) && ($size < $megabyte)) {
        return round($size / $kilobyte, $precision) . ' MB';
    } else if (($size >= $megabyte) && ($size < $gigabyte)) {
        return round($size / $megabyte, $precision) . ' GB';
    } else {
        return round($size / $gigabyte, $precision) . ' TB';
    }
}

function convertDate($date)
{
    $now = time();
    $upload_date = $now - $date;
    $seconds = $upload_date;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2419200);
    $years = round($seconds / 29030400);
    if ($seconds < 60) {
        if ($seconds < 10) {
            return 'A second ago';
        } else {
            return $seconds . ' second ago';
        }
    } elseif ($minutes < 60) {
        if ($minutes == 1) {
            return 'A minute ago';
        } else {
            return $minutes . ' minutes ago';
        }
    } elseif ($hours < 24) {
        if ($hours == 1) {
            return 'A hour ago';
        } else {
            return $hours . ' hours ago';
        }
    } elseif ($days < 7) {
        if ($days == 1) {
            return 'Yesterday';
        } else {
            return $days . ' days ago';
        }
    } elseif ($weeks < 4) {
        if ($weeks == 1) {
            return 'Last week';
        } else {
            return $weeks . ' weeks ago';
        }
    } elseif ($months < 12) {
        if ($months == 1) {
            return 'Last month';
        } else {
            return $months . ' months ago';
        }
    } else {
        if ($years == 1) {
            return 'Last year';
        } else {
            return $years . ' years ago';
        }
    }
}
?>