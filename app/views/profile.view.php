<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto my-4" style="max-width: 1000px;">

    <?php require_once APPROOT . '/views/includes/breadcrumb.php'; ?>

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <?php if (!empty($user->image)) : ?>
                <img src="<?= PUBROOT ?>/<?= $user->image; ?>" class="border border-primary d-block mx-auto rounded-circle " style="width:150px;">
            <?php else : ?>
                <?php if ($user->gender == 'female') : ?>
                    <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="border border-primary d-block mx-auto rounded-circle " style="width:150px;">
                <?php else : ?>
                    <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="border border-primary d-block mx-auto rounded-circle " style="width:150px;">
                <?php endif; ?>
            <?php endif; ?>

            <h3 class="text-center"><?= $user->firstname . " " . $user->lastname; ?></h3>
            <?php if (access('admin') || $_SESSION['user']->user_id == $user->user_id) : ?>
                <div class="text-center">
                    <a href="<?= URLROOT ?>/profile/edit/<?= $user->user_id ?>">
                        <button class="btn btn-sm btn-success">Edit</button>
                    </a>
                    <a href="<?= URLROOT ?>/profile/delete/<?= $user->user_id ?>">
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-8 col-md-9 bg-light p-2">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>First Name:</th>
                    <td><?= $user->firstname; ?></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><?= $user->lastname; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $user->email; ?></td>
                </tr>
                <tr>
                    <th>Rank:</th>
                    <th><?= str_replace("_", " ", $user->rank); ?></th>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <td><?= $user->gender; ?></td>
                </tr>
                <tr>
                    <th>Date Created:</th>
                    <td><?= get_date($user->date); ?></td>
                </tr>

            </table>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'info' ? 'active' : '' ?>" href="<?= URLROOT ?>/profile/<?= $user->user_id; ?>">Basic Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'classes' ? 'active' : '' ?>" href="<?= URLROOT ?>/profile/classes/<?= $user->user_id; ?>">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="<?= URLROOT ?>/profile/tests/<?= $user->user_id; ?>">Tests</a>
            </li>

        </ul>



        <?php

        switch ($page_tab) {
            case 'info':
                include(view_path('profile-tab-info'));
                break;
            case 'classes':
                include(view_path('profile-tab-classes'));
                break;
            case 'tests':
                include(view_path('profile-tab-tests'));
                break;
        }

        ?>

    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>