<style>
    nav ul li a {
        width: 110px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid thin #fff;
    }

    nav ul li a:hover {
        background-color: grey;
        color: white !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
    <a class="navbar-brand" href="#">
        <img src="<?= PUBROOT ?>/assets/logo.png" class="" style="width:50px;">
        <?= $_SESSION['user']->school; ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link active" href="<?= URLROOT ?>">DASHBOARD</a>
            </li>
            <?php if (access('super_admin')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/schools">SCHOOLS</a>
                </li>
            <?php endif; ?>
            <?php if (access('lecturer')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/users">STAFF</a>
                </li>
            <?php endif; ?>
            <?php if (access('lecturer')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/students">STUDENTS</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= URLROOT ?>/classes">CLASSES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URLROOT ?>/tests">TESTS</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['user']->firstname; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?= URLROOT ?>/profile/<?= $_SESSION['user']->user_id; ?>">Profile</a>
                    <a class="dropdown-item" href="<?= URLROOT ?>">Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= URLROOT ?>/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>