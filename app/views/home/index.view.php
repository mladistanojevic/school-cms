<?php require_once APPROOT . '/views/includes/head.php' ?>
<?php require_once APPROOT . '/views/includes/nav.php' ?>
<style>
    h1 {
        font-size: 80px;
        color: limegreen;
    }

    a {
        text-decoration: none;
    }

    .card-header {
        font-weight: bold;
    }

    .card {
        min-width: 250px;
    }
</style>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">

    <div class="row justify-content-center ">
        <?php if (access('super_admin')) : ?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?= URLROOT ?>/schools">
                    <div class="card-header">SCHOOLS</div>
                    <h1 class="text-center">
                        <i class="fa fa-graduation-cap"></i>
                    </h1>
                    <div class="card-footer">View all schools</div>
                </a>
            </div>
        <?php endif; ?>

        <?php if (access('reception')) : ?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?= URLROOT ?>/users">
                    <div class="card-header">STAFF</div>
                    <h1 class="text-center">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </h1>
                    <div class="card-footer">View all staff members</div>
                </a>
            </div>
        <?php endif; ?>

        <?php if (access('lecturer')) : ?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?= URLROOT ?>/students">
                    <div class="card-header">STUDENTS</div>
                    <h1 class="text-center">
                        <i class="fa fa-user-graduate"></i>
                    </h1>
                    <div class="card-footer">View all students</div>
                </a>
            </div>
        <?php endif; ?>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?= URLROOT ?>/classes">
                <div class="card-header">CLASSES</div>
                <h1 class="text-center">
                    <i class="fa fa-university"></i>
                </h1>
                <div class="card-footer">View all classes</div>
            </a>
        </div>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?= URLROOT ?>/tests">
                <div class="card-header">TESTS</div>
                <h1 class="text-center">
                    <i class="fa fa-file-signature"></i>
                </h1>
                <div class="card-footer">View all tests</div>
            </a>
        </div>

        <?php if (access('admin')) : ?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?= URLROOT ?>/statistics">
                    <div class="card-header">STATISTICS</div>
                    <h1 class="text-center">
                        <i class="fa fa-chart-pie"></i>
                    </h1>
                    <div class="card-footer">View student statistics</div>
                </a>
            </div>
        <?php endif; ?>

        <?php if (access('admin')) : ?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?= URLROOT ?>/settings">
                    <div class="card-header">SETTINGS</div>
                    <h1 class="text-center">
                        <i class="fa fa-cogs"></i>
                    </h1>
                    <div class="card-footer">View app settings</div>
                </a>
            </div>
        <?php endif; ?>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?= URLROOT ?>/profile/<?= $_SESSION['user']->user_id; ?>">
                <div class="card-header">PROFILE</div>
                <h1 class="text-center">
                    <i class="fa fa-id-card"></i>
                </h1>
                <div class="card-footer">View your profile</div>
            </a>
        </div>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?= URLROOT ?>/logout">
                <div class="card-header">LOGOUT</div>
                <h1 class="text-center">
                    <i class="fa fa-sign-out-alt"></i>
                </h1>
                <div class="card-footer">Logout from the system</div>
            </a>
        </div>

    </div>
</div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>