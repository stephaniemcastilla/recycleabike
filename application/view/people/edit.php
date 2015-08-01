<div class="container">
    <h1>PersonController/edit/:id</h1>

    <div class="box">
        <h2>Edit a person</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->person) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>people/update">
                <label>Change text of person: </label>
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="uuid" value="<?php echo htmlentities($this->person->id); ?>" />
                <input type="text" name="first" value="<?php echo htmlentities($this->person->first); ?>" />
                <input type="text" name="last" value="<?php echo htmlentities($this->person->last); ?>" />
                <input type="text" name="email" value="<?php echo htmlentities($this->person->email); ?>" />
                <input type="submit" value='Change' />
            </form>
        <?php } else { ?>
            <p>This person does not exist.</p>
        <?php } ?>
    </div>
</div>
