<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<br>
<center><h1>Welcome to <?php echo $this->program->name; ?>!</h1>
<p><i>Please select from the options below:</i></p></center>
<div class="timeclock" style="margin-top: 50px;">
  <a class="button-half" href="<?= Config::get('URL') . 'timeclock/signin/' . $this->event->uuid; ?>">SIGN IN</a>
  <a class="button-half" href="<?= Config::get('URL') . 'timeclock/signout/' . $this->event->uuid; ?>">SIGN OUT</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/status/' . $this->event->uuid; ?>">EVENT OVERVIEW</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/status/' . $this->event->uuid; ?>">PURCHASE PARTS</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/status/' . $this->event->uuid; ?>">REGISTER PROFILE</a>
</div>

