<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>



    <div class="card-group justify-content-center">

        <div class="card-group justify-content-center">

            <form method="post">
                <h3>Edit Class</h3>

                <input class="form-control my-3" value="<?= $class->class ?>" type="text" name="class" placeholder="Class name" autofocus>
                <?php if ($classError) : ?>
                    <div class="alert alert-danger my-2" style="text-align:center;">
                        <?= $classError ?>
                    </div>
                <?php endif; ?>
                <input class="btn btn-primary float-end" type="submit" value="Save">

                <a href="<?= URLROOT ?>/classes">
                    <input class="btn btn-danger" type="button" value="Cancel">
                </a>
            </form>
        </div>

    </div>



</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>