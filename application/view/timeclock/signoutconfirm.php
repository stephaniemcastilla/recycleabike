<?php $this->renderFeedbackMessages(); ?>
<?= htmlentities($this->person->first) ?>, you have successfully signed out. 
<br>
Your sign out time has been saved as <?= htmlentities($this->hour->end)?>.
<br>


<a href="<?= Config::get('URL') . 'timeclock/event/'. htmlentities($this->event->uuid); ?>">Back to Main Page</a>