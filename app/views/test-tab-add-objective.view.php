<center>
    <h5>Add Objective Questions</h5>
</center>

<form method="POST" enctype="multipart/form-data" class="my-4">
    <textarea name="question" class="form-control" placeholder="Please enter a question" autofocus></textarea>
    <?php if ($questionError) : ?>
        <div class="alert alert-danger my-2" style="text-align:center;">
            <?= $questionError ?>
        </div>
    <?php endif; ?>
    <div class="input-group mb-3 my-3">
        <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-image"></i>Comment</label>
        <input type="text" class="form-control" name="comment" placeholder="(Optional)">
    </div>

    <div class="input-group mb-3 my-3">
        <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-image"></i>Answer</label>
        <input type="text" class="form-control" name="answer" placeholder="Enter correct answer">
    </div>
    <?php if ($answerError) : ?>
        <div class="alert alert-danger my-2" style="text-align:center;">
            <?= $answerError ?>
        </div>
    <?php endif; ?>

    <div class="input-group mb-3 my-3">
        <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-image"></i>image(optional)</label>
        <input type="file" name="image" class="form-control" id="inputGroupFile01">
    </div>

    <a class="ms-4" href="<?= URLROOT . '/test/' . $test->test_id ?>">
        <button type="button" class="btn btn-danger">Back To Test</button>
    </a>
    <button class="btn btn-success float-end" type="submit">Save Question</button>
</form>