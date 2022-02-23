<div class="card-group justify-content-center">

    <div class="card-group justify-content-center">

        <form method="POST">
            <h3>EditTest</h3>
            <input autofocus class="form-control my-3" value="<?= $test->test; ?>" type="text" name="test" placeholder="Test Name">
            <textarea name="description" class="form-control mb-4" placeholder="Desctibe test..."><?= $test->description; ?></textarea>
            <select name="disabled" class="form-control mb-5">
                <?php if ($test->disabled) : ?>
                    <option value="1">Disabled</option>
                    <option value="0">Active</option>
                <?php else : ?>
                    <option value="0">Active</option>
                    <option value="1">Disabled</option>
                <?php endif; ?>
            </select>
            <?php if ($testError) : ?>
                <div class="alert alert-danger my-2" style="text-align:center;">
                    <?= $testError ?>
                </div>
            <?php endif; ?>
            <input class="btn btn-primary float-end" type="submit" value="Update">

            <a href="<?= URLROOT ?>/single_class/tests/<?= $class->class_id; ?>">
                <input class="btn btn-danger" type="button" value="Cancel">
            </a>
        </form>
    </div>

</div>