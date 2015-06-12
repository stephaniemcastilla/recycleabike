<form method="post" class="form-horizontal" action="<?php echo Config::get('URL');?>timeclock/eventCreate">
  <div class="form-group form-md-line-input">
		<label class="col-md-2 control-label" for="form_control_1">Regular input</label>
		<div class="col-md-10">
			<input type="text" class="form-control" id="form_control_1" placeholder="Enter your name">
			<div class="form-control-focus">
			</div>
		</div>
	</div>
    <label>New event: </label><br/>
    <input type="date" name="date" /><br/>
    <input type="time" name="start" /><br/>
    <input type="time" name="end" /><br/>
    <select name="program_id">
    <?php foreach($this->programs as $key => $value) { ?>
        <option value="<?= htmlentities($value->uuid); ?>"><?= htmlentities($value->name); ?></option>
    <?php } ?>
    </select><br/>
    <input type="submit" value='Create this event' autocomplete="off" />
</form>