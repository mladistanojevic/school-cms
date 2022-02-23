<form method="POST" class="form my-2 mx-auto" style="width:100%;max-width:400px">
    <h4>Add Student</h4>
    <?php if ($studentExistsError) : ?>
        <div class="alert alert-danger" style="text-align:center;">
            <?= $studentExistsError ?>
        </div>
    <?php endif; ?>
    <?php if ($searchError) : ?>
        <div class="alert alert-danger" style="text-align:center;">
            <?= $searchError ?>
        </div>
    <?php endif; ?>
    <input class="form-control" type="text" name="name" placeholder="Student Name" value="<?= get_var('name'); ?>" autofocus>
    <a href="<?= URLROOT . '/single_class/students/' . $class->class_id  ?>">
        <button type="button" class="btn btn-danger my-2 ">Cancel</button>
    </a>
    <button class="btn btn-primary my-2 float-end" name="search">Search</button>
    <div class="clearfix"></div>
</form>

<div class="container-fluid">
    <form method="POST">
        <?php if (isset($results) && $results) : ?>

            <table class="table table-striped table-hover">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($results as $user) : ?>
                    <tr>
                        <td><?= $user->firstname . " " . $user->lastname; ?></td>
                        <td><button value="<?= $user->user_id ?>" name="selected" class="btn btn-sm btn-danger">Select</button></td>
                    </tr>


                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <h4 class="text-center">No students were found at this time</h4>
            <?php endif; ?>
        <?php endif; ?>
    </form>

</div>