<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>

    <h5>Tests</h5>
    <div class="card-group justify-content-center">
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                    </div>
                    <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
                </div>
            </form>
        </nav>
        <table class="table table-striped table-hover my-2">
            <tr>
                <th></th>
                <th>Active</th>
                <th>Test Name</th>
                <th>Description</th>
                <th>Created by</th>
                <?php if ($_SESSION['user']->rank != 'student') : ?>
                    <th>School</th>
                <?php endif; ?>
                <th>Class</th>
                <th></th>
                <td></td>
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
                        <td><?= $test->firstname . " " . $test->lastname; ?></td>
                        <?php if ($_SESSION['user']->rank != 'student') : ?>
                            <td><?= $test->school; ?></td>
                        <?php endif; ?>
                        <th><?= $test->class; ?></th>
                        <td>
                            <?php if (($test->disabled == 0) && $_SESSION['user']->rank == 'student') : ?>
                                <a href="<?= URLROOT ?>/take_test/<?= $test->test_id; ?>">
                                    <button class="btn btn-sm btn-primary">Take this test</button>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($_SESSION['user']->user_id == $test->user_id) : ?>
                                <a href="<?= URLROOT ?>/single_class/testedit/<?= $test->test_id; ?>/<?= $test->class_id; ?>">
                                    <button class=" btn btn-sm btn-info"><i class="fas fa-edit text-white"></i></button>
                                </a>
                                <a href="<?= URLROOT ?>/single_class/testdelete/<?= $test->test_id; ?>/<?= $test->class_id; ?>">
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
    </div>



</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>