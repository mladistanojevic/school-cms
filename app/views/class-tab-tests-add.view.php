<div class="card-group justify-content-center">

    <div class="card-group justify-content-center">

        <form method="POST">
            <h3>Add New Test</h3>
            <input autofocus class="form-control my-3" value="<?= get_var('test') ?>" type="text" name="test" placeholder="Test Name">
            <textarea name="description" class="form-control mb-4" placeholder="Desctibe test..."></textarea>
            <?php if ($testError) : ?>
                <div class="alert alert-danger my-2" style="text-align:center;">
                    <?= $testError ?>
                </div>
            <?php endif; ?>
            <input class="btn btn-primary float-end" type="submit" value="Create">

            <a href="<?= URLROOT ?>/single_class/tests/<?= $class->class_id; ?>">
                <input class="btn btn-danger" type="button" value="Cancel">
            </a>
        </form>
    </div>

</div>