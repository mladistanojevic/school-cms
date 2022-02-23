<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid p-4 shadow mx-auto my-4" style="max-width: 1000px;">
    <center>
        <h4>Edit Profile</h4>
    </center>
    <form action="<?= URLROOT ?>/profile/edit/<?= $user->user_id; ?>" method="POST" enctype="multipart/form-data">
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
                <?php if (access('admin') || $_SESSION['user']->user_id == $user->user_id) : ?>
                    <div class="text-center my-2">
                        <label for="image" class="btn btn-sm btn-secondary">
                            <input onchange="display_image_name(this.files[0].name);" value="<?= $user->image; ?>" id="image" type="file" name="image" style="display:none">Browse image
                        </label>
                        <br>
                        <small class="text-muted file_info"></small>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">

                <div class="p-4 mx-auto mr-4 shadow rounded mb-2">

                    <input class="my-2 form-control" type="firstname" name="firstname" value="<?= $user->firstname; ?>" placeholder="Frist Name" value="<?= get_var('firstname'); ?>">
                    <?php if ($firstnameError) : ?>
                        <div class="alert alert-danger" style="text-align:center;">
                            <?= $firstnameError ?>
                        </div>
                    <?php endif; ?>
                    <input class="my-2 form-control" type="lastname" name="lastname" value="<?= $user->lastname; ?>" placeholder="Last Name" value="<?= get_var('lastname'); ?>">
                    <?php if ($lastnameError) : ?>
                        <div class="alert alert-danger" style="text-align:center;">
                            <?= $lastnameError ?>
                        </div>
                    <?php endif; ?>


                    <select class="my-2 form-control" name="gender" placeholder="Gender" required>
                        <?php if ($user->gender == 'female') : ?>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        <?php else : ?>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        <?php endif; ?>

                    </select>


                    <a href="<?= URLROOT ?>/profile/<?= $user->user_id ?>">
                        <button type="button" class="btn btn-sm btn-secondary">Back To Profile</button>
                    </a>
                    <button type="submit" class="float-end btn btn-sm btn-success">Save Changes</button>
                </div>


            </div>
        </div>
    </form>

</div>

</div>

<script>
    function display_image_name(file_name) {
        document.querySelector('.file_info').innerHTML = '<b>Selected file: </b><br/>:' + file_name;
    }
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>