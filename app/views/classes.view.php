<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>


    <h5>Classes</h5>
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
                <th>Class Name</th>
                <th>Created by</th>
                <th>School</th>
                <th>Date</th>
                <th>
                    <?php if (access('lecturer')) : ?>
                        <a href="<?= URLROOT ?>/classes/add">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>Add New</button>
                        </a>
                    <?php endif; ?>
                </th>
            </tr>

            <?php if ($classes) : ?>
                <?php foreach ($classes as $class) : ?>
                    <tr>
                        <td>
                            <?php if (access('lecturer')) : ?>
                                <a href="<?= URLROOT ?>/single_class/<?= $class->class_id; ?>">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-chevron-right"></i></button>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td><?= $class->class; ?></td>
                        <td><?= $class->firstname . " " . $class->lastname; ?></td>
                        <td><?= $class->school; ?></td>
                        <td><?= get_date($class->date); ?></td>
                        <td>
                            <?php if (access('lecturer') && $_SESSION['user']->user_id == $class->user_id) : ?>
                                <a href="<?= URLROOT ?>/classes/edit/<?= $class->class_id; ?>">
                                    <button class=" btn btn-sm btn-info"><i class="fas fa-edit text-white"></i></button>
                                </a>
                                <a href="<?= URLROOT ?>/classes/delete/<?= $class->class_id; ?>">
                                    <button class=" btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else : ?>
                <h4>No classes were found at this time</h4>
            <?php endif; ?>
        </table>
    </div>



</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>