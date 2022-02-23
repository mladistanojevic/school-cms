<h3>Classes</h3>
<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
</nav>
<div class="container">
    <table class="table table-striped table-hover my-2">
        <tr>
            <th></th>
            <th>Class Name</th>
            <th>School</th>
            <th>Date</th>
        </tr>

        <?php if ($classes) : ?>
            <?php foreach ($classes as $class) : ?>

                <tr>
                    <td>
                        <?php if (access('lecturer')) : ?>
                            <a href="<?= URLROOT ?>/single_class/<?= $class->class_id; ?>">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-chevron-right"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                    <td><?= $class->class; ?></td>
                    <td><?= $class->school; ?></td>
                    <td><?= get_date($class->date); ?></td>
                </tr>

            <?php endforeach; ?>

        <?php else : ?>
            <tr>
                <td colspan="5">
                    <center> No classes were found at this time</center>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>