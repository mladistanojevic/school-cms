<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
    <div>
        <?php if (access('lecturer')) : ?>
            <a href="<?= URLROOT . '/single_class/testadd/' . $class->class_id ?>">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Test</button>
            </a>
        <?php endif; ?>
    </div>
</nav>
<table class="table table-striped table-hover my-2">
    <tr>
        <th></th>
        <th>Active</th>
        <th>Test Name</th>
        <th>Description</th>
        <th>Taken</th>
        <th>Created by</th>
        <th></th>
    </tr>

    <?php if ($tests) : ?>
        <?php foreach ($tests as $test) : ?>
            <tr>
                <td>
                    <?php if (access('lecturer')) : ?>
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
                <td><?= $test->firstname . " " . $test->lastname; ?></td>
                <td>
                    <?php if (access('lecturer') && $_SESSION['user']->user_id == $test->user_id) : ?>
                        <a href="<?= URLROOT ?>/single_class/testedit/<?= $test->test_id; ?>/<?= $class->class_id; ?>">
                            <button class=" btn btn-sm btn-info"><i class="fas fa-edit text-white"></i></button>
                        </a>
                        <a href="<?= URLROOT ?>/single_class/testdelete/<?= $test->test_id; ?>/<?= $class->class_id; ?>">
                            <button class=" btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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