<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto my-4" style="max-width: 1000px;">

    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>
    <div class="row">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Test Name:</th>
                <th><?= $test->test; ?></th>
            </tr>
            <tr>
                <th>Created by:</th>
                <td><?= $test->firstname . " " . $test->lastname; ?></td>
            </tr>
            <tr>
                <th>Date created:</th>
                <td><?= $test->date; ?></td>
            </tr>
            <tr>
                <th>Description:</th>
                <td><?= $test->description; ?></td>
            </tr>
            <tr>
                <th>School:</th>
                <td><?= $test->school; ?></td>
            </tr>
            <tr>
                <th>Class:</th>
                <td><?= $test->class; ?>
                    <a class="ms-4" href="<?= URLROOT . '/single_class/tests/' . $test->class_id ?>">
                        <button class="btn btn-sm btn-success">View Class</button>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Active:</th>
                <?php if ($test->disabled) : ?>
                    <td>
                        <h3><i class="fas fa-times-circle" style="color: red;"></i></h3>
                    </td>
                <?php else : ?>
                    <td>
                        <h3><i class="fas fa-check-circle" style="color:green"></i></h3>
                    </td>
                <?php endif; ?>
            </tr>


        </table>

    </div>



    <?php
    switch ($page_tab) {
        case 'view':
            include(view_path('test-tab-view'));
            break;
        case 'add-subjective':
            include(view_path('test-tab-add-subjective'));
            break;
        case 'add-objective':
            include(view_path('test-tab-add-objective'));
            break;
        case 'edit':
            include(view_path('test-tab-edit'));
            break;
        default:
            break;
    }
    ?>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>