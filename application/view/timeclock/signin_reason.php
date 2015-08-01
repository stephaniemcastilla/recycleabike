<br>
<center><h1>Sign in as a:</h1>

<div class="timeclock" style="margin-top: 50px;">
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/signinvolunteer/' . htmlentities($this->event); ?>">VOLUNTEER</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/signinperson/' . htmlentities($this->event); ?>">CUSTOMER</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/signinperson/' . htmlentities($this->event); ?>">VISITOR</a>
</div>