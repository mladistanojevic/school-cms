<nav class="navbar">
    <center>
        <p><b>Total Questions: <?= $qusetion_number; ?></b> </p>
    </center>
</nav>

<hr>

<?php if (isset($questions) && is_array($questions)) : ?>
    <form action="" method="POST">
        <?php $num = 0; ?>
        <?php foreach ($questions as $question) : $num++ ?>
            <div class="card my-4">
                <div class="card-header">
                    <span class="bg-primary p-1 text-white rounded">Question #<?= $num; ?></span> <span class="float-end"><?= date("F jS, Y H:i:s a", strtotime($question->date)); ?></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $question->question; ?></h5>
                    <?php if ($question->image) : ?>
                        <img src="<?= PUBROOT ?>/<?= $question->image; ?>" style="width:250px;height:250px">
                    <?php endif; ?>
                    <p class="car-text"><?= $question->comment; ?></p>
                    <hr>
                    <input type="text" class="form-control" name="<?= $question->test_questions_id; ?>" placeholder="Type your answer here">


                </div>
            </div>
        <?php endforeach; ?>
        <center><button type="submit" class="btn btn-primary px-5">Finish</button></center>
    </form>
<?php endif; ?>