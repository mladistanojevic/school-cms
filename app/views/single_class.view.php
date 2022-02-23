<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto my-4" style="max-width: 1000px;">

    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>
    <div class="row">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Class Name:</th>
                <th><?= $class->class; ?></th>
            </tr>
            <tr>
                <th>Created by:</th>
                <td><?= $class->firstname . " " . $class->lastname; ?></td>
            </tr>
            <tr>
                <th>Date created:</th>
                <td><?= $class->date; ?></td>
            </tr>

        </table>

    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?= $page_tab == 'lecturers' ? 'active' : '' ?>" href="<?= URLROOT . '/single_class/' . $class->class_id ?>">Lecturers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $page_tab == 'students' ? 'active' : '' ?>" href="<?= URLROOT . '/single_class/students/' . $class->class_id ?>">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="<?= URLROOT . '/single_class/tests/' . $class->class_id ?>">Tests</a>
        </li>

    </ul>



    <?php
    switch ($page_tab) {
        case 'lecturers':
            include(view_path('class-tab-lecturers'));
            break;
        case 'students':
            include(view_path('class-tab-students'));
            break;
        case 'tests':
            include(view_path('class-tab-tests'));
            break;
        case 'lecturer-add':
            include(view_path('class-tab-lecturers-add'));
            break;
        case 'lecturer-remove':
            include(view_path('class-tab-lecturers-remove'));
            break;
        case 'student-add':
            include(view_path('class-tab-students-add'));
            break;
        case 'student-remove':
            include(view_path('class-tab-students-remove'));
            break;
        case 'test-add':
            include(view_path('class-tab-tests-add'));
            break;
        case 'test-remove':
            include(view_path('class-tab-tests-remove'));
            break;
        case 'test-edit':
            include(view_path('class-tab-tests-edit'));
            break;
    }
    ?>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>