<div class="container">
    <h1>ProgramController/edit/:id</h1>

    <div class="box">
        <h2>Edit a Timesheet</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->program) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>programs/update">
                <label>Change text of program: </label>
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="uuid" value="<?php echo htmlentities($this->program->uuid); ?>" />
                <input type="text" name="id" value="<?php echo htmlentities($this->program->id); ?>" />
                <input type="text" name="name" value="<?php echo htmlentities($this->program->name); ?>" />
                <input type="submit" value='Change' />
            </form>
        <?php } else { ?>
            <p>This program does not exist.</p>
        <?php } ?>
    </div>
</div>
