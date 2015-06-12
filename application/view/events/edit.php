<div class="container">
    <h1></h1>

    <div class="box">
        <h2>Edit Event</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->event) { ?>
            <form method="post" action="<?php echo Config::get('URL');?>events/update">
                 <label>Edit event: </label><br/>
                 <input type="date" name="date" value="<?php echo htmlentities($this->event->date); ?>"/><br/>
                 <input type="time" name="start" value="<?php echo htmlentities($this->event->start); ?>"/><br/>
                 <input type="time" name="end" value="<?php echo htmlentities($this->event->end); ?>"/><br/>
                 <select name="program_id">
                 <?php foreach($this->programs as $key => $value) { ?>
                     <option value="<?= htmlentities($value->uuid); ?>"><?= htmlentities($value->name); ?></option>
                 <?php } ?>
                 </select><br/>
                 <input type="submit" class="btn blue" value='Update Event' / >
       			 </form>
        <?php } else { ?>
            <p>This bike does not exist.</p>
        <?php } ?>
    </div>
</div>
