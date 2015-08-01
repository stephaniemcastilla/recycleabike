<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<div class="pull-right"><a class="btn" href="<?= Config::get('URL') . 'events'; ?>">X</a></div>
<br>
<center><h1>Today's Events</h1></center>

<div class="timeclock" style="margin-top: 50px;">
<a class="btn default pull-right" href="<?= Config::get('URL') . 'timeclock/newevent/' ?>">+ Event</a>
<?php if ($this->events) { ?>
    <table class="event-table">
        <thead>
        <tr>
            <td></td>            
            <td>Event Date</td>
            <td>Event Start</td>
            <td>Event End</td>
            <td>Event Program</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($this->events as $key => $event) { ?>
                <tr>
                    <td><a href="<?= Config::get('URL') . 'events/edit/' . $event->id; ?>">Edit</a></td>
                    <td><?= htmlentities($event->date); ?></td>
                    <td><?= htmlentities($event->start); ?></td>
                    <td><?= htmlentities($event->end); ?></td>
                    <?php foreach($this->programs as $key => $program) { ?>
                      <?php if(htmlentities($program->id)==htmlentities($event->program_id)){?>
                        <td><?= htmlentities($program->name); ?></td>
                      <?php } ?>
                    <?php } ?>
                    <td><a href="<?= Config::get('URL') . 'timeclock/event/' . $event->id; ?>">Log Time</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div>No events scheduled for today.</div>
    <?php } ?>
</div>