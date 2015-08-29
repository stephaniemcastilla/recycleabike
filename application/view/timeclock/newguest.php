<br>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'timeclock/event/' . htmlentities($this->event); ?>" style="float: left;">< Back</a></div>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'events/'; ?>" style="float: left;">X</a></div>

<center><h1>New to Recycle-A-Bike?</h1>
<p><i>Please select from the options below:</i></p></center>
<div class="timeclock" style="margin-top: 50px;">
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/newsletter/' . $this->event; ?>">GET OUR NEWSLETTER</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/register/' . $this->event; ?>">SIGN UP TO VOLUNTEER</a>
  <a class="button-full" href="<?= Config::get('URL') . 'timeclock/contact/' . $this->event; ?>">CONTACT OUR DIRECTOR</a>
</div>

