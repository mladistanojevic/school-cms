<nav class="navbar">
    <center>
        <h5>Test Questions</h5>
        <p><b>Total Questions: <?= $qusetion_number; ?></b> </p>
    </center>
    <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bars"></i>Add
        </button>
        <ul class="dropdown-menu  dropdown-menu-end">
            <li><a class="dropdown-item" href="<?= URLROOT ?>/test/addquestion_objective/<?= $test->test_id ?>">
                    Add Objective Question</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?= URLROOT ?>/test/addquestion/<?= $test->test_id ?>">
                    Add Subjective Question</a>
            </li>
        </ul>
    </div>
</nav>

<hr>

<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = 0; ?>
    <?php foreach ($questions as $question) : $num++ ?>
        <div class="card my-4 shadow">
            <div class="card-header">
                <span class="bg-primary p-1 text-white rounded">Question #<?= $num; ?></span> <span class="float-end"><?= date("F jS, Y H:i:s a", strtotime($question->date)); ?></span>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $question->question; ?></h5>
                <?php if ($question->image) : ?>
                    <img src="<?= PUBROOT ?>/<?= $question->image; ?>" style="width:250px;height:250px">
                <?php endif; ?>
                <p class="car-text"><?= $question->comment; ?></p>
                <?php if ($question->question_type == 'objective') : ?>
                    <hr>
                    <p class="car-text"><b>Answer:</b> <?= $question->correct_answer; ?></p>
                    <hr>
                <?php endif; ?>
                <p class="float-end">
                    <?php if ($test->disabled == 0) : ?>
                        <a href="<?= URLROOT ?>/test/editquestion/<?= $question->test_id ?>/<?= $question->test_questions_id ?>">
                            <button class="btn btn-sm btn-info text-white pe-1"><i class="fas fa-edit"></i></button>
                        </a>
                        <a href="<?= URLROOT ?>/test/deletequestion/<?= $question->test_id ?>/<?= $question->test_questions_id ?>">
                            <button class="btn btn-sm btn-danger text-white pe-1"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>