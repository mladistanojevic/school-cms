<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>



    <div class="card-group justify-content-center">

        <div class="card-group justify-content-center">

            <form method="POST">
                <h3>Add New Class</h3>

                <input autofocus class="form-control my-3" value="<?= get_var('class') ?>" type="text" name="class" placeholder="Class Name">
                <?php if ($classError) : ?>
                    <div class="alert alert-danger my-2" style="text-align:center;">
                        <?= $classError ?>
                    </div>
                <?php endif; ?>
                <input class="btn btn-primary float-end" type="submit" value="Create">

                <a href="<?= URLROOT ?>/classes">
                    <input class="btn btn-danger" type="button" value="Cancel">
                </a>
            </form>
        </div>

    </div>



</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>