<?php require_once APPROOT . '/views/includes/head.php'; ?>
<div class="container-fluid">

    <form action="<?= URLROOT ?>/login" method="POST">
        <div class="p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px;width:100%;max-width: 340px;">
            <h2 class="text-center">My School</h2>
            <img src="<?= PUBROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width:100px;">
            <h3>Login</h3>
            <input class="form-control" value="<?= get_var('email'); ?>" type="email" name="email" placeholder="Email" autofocus><br>
            <?php if ($emailError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $emailError ?>
                </div>
            <?php endif; ?>
            <br>
            <input class="form-control" type="password" name="password" placeholder="Password"><br>
            <?php if ($passwordError) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $passwordError ?>
                </div>
            <?php endif; ?>
            <br>
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>