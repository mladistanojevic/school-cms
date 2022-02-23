<h3>Tests</h3>
<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
</nav>

<table class="table table-striped table-hover my-2">
    <tr>
        <th></th>
        <th>Active</th>
        <th>Test Name</th>
        <th>Description</th>
        <th>Taken</th>
        <th></th>
    </tr>

    <?php if ($tests) : ?>
        <?php foreach ($tests as $test) : ?>
            <tr>
                <td>
                    <?php if ($_SESSION['user']->rank != 'student') : ?>
                        <a href="<?= URLROOT ?>/test/<?= $test->test_id; ?>">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-chevron-right"></i></button>
                        </a>
                    <?php endif; ?>
                </td>
                <?php if (!$test->disabled) : ?>
                    <td class="text-center">
                        <h3><i class="fas fa-check-circle" style="color:green"></i></h3>
                    </td>
                <?php else : ?>
                    <td class="text-center">
                        <h3><i class="fas fa-times-circle" style="color: red;"></i></h3>
                    </td>
                <?php endif; ?>
                <th><?= $test->test; ?></th>
                <td><?= $test->description; ?></td>
                <?php if (has_taken_test($test->test_id)) : ?>
                    <td class="text-center">
                        <b>YES</b>
                    </td>
                <?php else : ?>
                    <td class="text-center">
                        <b>NO</b>
                    </td>
                <?php endif; ?>

                <td>
                    <?php if (($test->disabled == 0) && $_SESSION['user']->rank == 'student') : ?>
                        <a href="<?= URLROOT ?>/take_test/<?= $test->test_id; ?>">
                            <button class="btn btn-sm btn-primary">Take this test</button>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php else : ?>
        <tr>
            <td colspan="7">
                <center>
                    <h4>No tests were found at this time</h4>
                </center>
            </td>
        </tr>

    <?php endif; ?>
</table>