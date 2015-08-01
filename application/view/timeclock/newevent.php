<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<div class="pull-right"><a class="btn" href="<?= Config::get('URL') . 'events'; ?>">X</a></div>
<br>
<center><h1>New Event</h1></center>

<div class="timeclock" style="margin-top: 50px;">
<form method="post" class="form-horizontal" action="<?php echo Config::get('URL');?>timeclock/eventCreate">
    <select name="program_id">
    <?php foreach($this->programs as $key => $value) { ?>
        <option value="<?= htmlentities($value->uuid); ?>"><?= htmlentities($value->name); ?></option>
    <?php } ?>
    </select><br/>
    <input type="date" name="date" value="<?php echo date('Y-m-d');?>"/><br/>
    <input type="time" name="start" value="<?php echo date('h:m');?>"/><br/>
    <input type="time" name="end" /><br/>

    <input type="submit" value='Create this event' autocomplete="off" />
</form>
</div>