<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
    <div>
        <?php if (access('lecturer')) : ?>
            <a href="<?= URLROOT . '/single_class/lectureradd/' . $class->class_id  ?>">
                <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>Add New</button>
            </a>
            <a href="<?= URLROOT . '/single_class/lecturerremove/' . $class->class_id  ?>">
                <button class="btn btn-sm btn-danger"><i class="fas fa-minus"></i>Remove</button>
            </a>
        <?php endif; ?>
    </div>
</nav>
<div class="card-group justify-content-center my-4">
    <?php if ($lecturers) : ?>
        <?php foreach ($lecturers as $lecturer) : ?>
            <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                <?php if ($lecturer->gender == 'female') : ?>
                    <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="card-img-top " alt="Card image cap">
                <?php else : ?>
                    <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="card-img-top " alt="Card image cap">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $lecturer->firstname ?> <?= $lecturer->lastname ?></h5>
                    <p class="card-text"><?= str_replace("_", " ", $lecturer->rank) ?></p>
                    <a href="<?= URLROOT ?>/profile/<?= $lecturer->user_id; ?>" class="btn btn-primary">Profile</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <h5>There is no lecturers at this moment!</h5>
    <?php endif; ?>
</div>