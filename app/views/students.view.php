<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                </div>
                <input type="text" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" name="search">
            </div>
        </form>
        <?php if (access('reception')) : ?>
            <a href="<?= URLROOT ?>/signup?mode=<?= $mode; ?>">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
            </a>
        <?php endif; ?>
    </nav>


    <div class="card-group justify-content-center my-4">

        <?php if ($students) : ?>
            <?php foreach ($students as $student) : ?>

                <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                    <?php if (!empty($student->image)) : ?>
                        <img src="<?= PUBROOT ?>/<?= $student->image; ?>" class="card-img-top " alt="Card image cap">
                    <?php else : ?>
                        <?php if ($student->gender == 'female') : ?>
                            <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="card-img-top " alt="Card image cap">
                        <?php else : ?>
                            <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="card-img-top " alt="Card image cap">
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= $student->firstname ?> <?= $student->lastname ?></h5>
                        <p class="card-text"><?= str_replace("_", " ", $student->rank) ?></p>
                        <?php if (access('lecturer')) : ?>
                            <a href="<?= URLROOT ?>/profile/<?= $student->user_id; ?>" class="btn btn-primary">Profile</a>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>No student members were found at this time</h4>
        <?php endif; ?>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php $pager->display() ?>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>