<br>
<center><h1>Goodbye <?= htmlentities($this->person->first) ?>!</h1>
<p><i>You are successfully signed out.</p></center>
<div class="timeclock" style="margin-top: 50px;">
  <center>
  <h3>You have <b><?= htmlentities($this->person_points) ?></b> points.</h3>
  <br>
  <a href="<?= Config::get('URL') . 'timeclock/event/'. htmlentities($this->event->id); ?>">Back to Main Page</a>
  </center>
</div>