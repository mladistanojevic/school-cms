<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>


    <h5>Schools</h5>
    <div class="card-group justify-content-center">

        <table class="table table-striped table-hover my-2">
            <tr>
                <th></th>
                <th>School</th>
                <th>Created by</th>
                <th>Date</th>
                <th>
                    <a href="<?= URLROOT ?>/schools/add">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>Add New</button>
                    </a>
                </th>
            </tr>

            <?php if ($schools) : ?>
                <?php foreach ($schools as $school) : ?>

                    <tr>
                        <td><button class="btn btn-sm btn-primary"><i class="fas fa-chevron-right"></i></button></td>
                        <td><?= $school->school; ?></td>
                        <td><?= $school->firstname . " " . $school->lastname; ?></td>
                        <td><?= get_date($school->date); ?></td>
                        <td>
                            <a href="<?= URLROOT ?>/schools/edit/<?= $school->school_id; ?>">
                                <button class=" btn btn-sm btn-info"><i class="fas fa-edit text-white"></i></button>
                            </a>
                            <a href="<?= URLROOT ?>/schools/delete/<?= $school->school_id; ?>">
                                <button class=" btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </a>
                            <a href="<?= URLROOT ?>/switch_school/<?= $school->school_id; ?>">
                                <button class=" btn btn-sm btn-success">Switch to<i class="fas fa-chevron-right"></i></button>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else : ?>
                <h4>No schools were found at this time</h4>
            <?php endif; ?>
        </table>
    </div>



</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>