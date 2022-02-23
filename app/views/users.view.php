<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                </div>
                <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>
        </form>
        <a href="<?= URLROOT ?>/signup">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
        </a>
    </nav>


    <div class="card-group justify-content-center my-4">

        <?php if ($users) : ?>
            <?php foreach ($users as $user) : ?>

                <?php include(view_path('user')); ?>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>No staff members were found at this time</h4>
        <?php endif; ?>
    </div>
    <?php if (!isset($_GET['search'])) : ?>
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <?php $pager->display() ?>
                </div>
            </div>
        </div>
    <?php endif; ?>



</div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>