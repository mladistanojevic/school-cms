<div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
    <?php if (!empty($user->image)) : ?>
        <img src="<?= PUBROOT ?>/<?= $user->image; ?>" class="card-img-top " alt="Card image cap">
    <?php else : ?>
        <?php if ($user->gender == 'female') : ?>
            <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="card-img-top " alt="Card image cap">
        <?php else : ?>
            <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="card-img-top " alt="Card image cap">
        <?php endif; ?>
    <?php endif; ?>

    <div class="card-body">
        <h5 class="card-title"><?= $user->firstname ?> <?= $user->lastname ?></h5>
        <p class="card-text"><?= str_replace("_", " ", $user->rank) ?></p>
        <a href="<?= URLROOT ?>/profile/<?= $user->user_id; ?>" class="btn btn-primary">Profile</a>
    </div>
</div>