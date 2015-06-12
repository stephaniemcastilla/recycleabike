Welcome <?= htmlentities($this->person->first) ?>!

You are signed in to <?= htmlentities($this->program->name) ?>


<a href="<?= Config::get('URL') . 'timeclock/event/'. htmlentities($this->event->uuid); ?>">Back to Main Page</a>