<?php require_once APPROOT . '/views/includes/head.php'; ?>
<div class="container-fluid">
    <form action="<?= URLROOT ?>/signup" method="POST">
        <div class="p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px;width:100%;max-width: 340px;">
            <h2 class="text-center">My School</h2>
            <img src="<?= PUBROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width:100px;">
            <h3>Add User</h3>
            <input class="my-2 form-control" type="firstname" name="firstname" placeholder="Frist Name" value="<?= get_var('firstname'); ?>">
            <?php if ($firstnameError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $firstnameError ?>
                </div>
            <?php endif; ?>
            <input class="my-2 form-control" type="lastname" name="lastname" placeholder="Last Name" value="<?= get_var('lastname'); ?>">
            <?php if ($lastnameError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $lastnameError ?>
                </div>
            <?php endif; ?>
            <input class="my-2 form-control" type="email" name="email" placeholder="Email" value="<?= get_var('email'); ?>">
            <?php if ($emailError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $emailError ?>
                </div>
            <?php endif; ?>

            <select class="my-2 form-control" name="gender" placeholder="Gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <?php if ($mode == 'students') : ?>
                <select class="my-2 form-control" name="rank" placeholder="Rank" required>
                    <option value="student">Student</option>
                </select>
            <?php else : ?>
                <select class="my-2 form-control" name="rank" placeholder="Rank" required>
                    <option value="reception">Reception</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="admin">Admin</option>
                    <?php if ($_SESSION['user']->rank == 'super_admin') : ?>
                        <option value="super_admin">Super Admin</option>
                    <?php endif; ?>
                </select>
            <?php endif; ?>

            <input class="my-2 form-control" type="text" name="password" placeholder="Password">
            <?php if ($passwordError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $passwordError ?>
                </div>
            <?php endif; ?>
            <input class="my-2 form-control" type="text" name="password2" placeholder="Retype Password">
            <?php if ($password2Error) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $password2Error ?>
                </div>
            <?php endif; ?>
            <br>
            <button class="btn btn-primary float-end">Add User</button>
            <?php if ($mode == 'users') : ?>
                <a href="<?= URLROOT ?>/users">
                    <button class="btn btn-danger" type="button">Cancel</button>
                </a>
            <?php else : ?>
                <a href="<?= URLROOT ?>/students">
                    <button class="btn btn-danger" type="button">Cancel</button>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>