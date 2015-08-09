<br>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'events/'; ?>" style="float: left;">X</a></div>

<center><h1>Welcome to <?php echo $this->program->name; ?>!</h1>
<p><i>Please select from the options below:</i></p></center>
<div class="timeclock" style="margin-top: 50px;">
  <a class="button-half" href="<?= Config::get('URL') . 'timeclock/signin/' . $this->event->id; ?>">SIGN IN</a>
  <a class="button-half" href="<?= Config::get('URL') . 'timeclock/signout/' . $this->event->id; ?>">SIGN OUT</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/newguest/' . $this->event->id; ?>" style="font-size: 30px; font-style: italic;">NEW TO RECYCLE-A-BIKE?</a>
  <a href="<?= Config::get('URL') . 'timeclock/view/' . $this->event->id; ?>" style="float: left; display: block; padding-top: 100px; width: 100%; text-align: center; font-size: 20px;">FOR ADMINS ONLY</a>
  <!-- <a class="button-full" href="<?= Config::get('URL') . 'timeclock/status/' . $this->event->id; ?>">PURCHASE BIKES & PARTS</a> -->
  
</div>

