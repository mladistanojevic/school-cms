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
                <th>Description:</th>
                <td><?= $test->description; ?></td>
            </tr>
            <tr>
                <th>School:</th>
                <td><?= $test->school; ?></td>
            </tr>



        </table>

    </div>



    <?php
    switch ($page_tab) {
        case 'view':
            include(view_path('take-test-tab'));
            break;
        default:
            break;
    }
    ?>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>