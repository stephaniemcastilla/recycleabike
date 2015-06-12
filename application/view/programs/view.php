<div class="container">
    <?php if ($this->program) { ?>
    <h1><?= htmlentities($this->program->name); ?></h1>
    <div class="box">
        <h2>Details</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        
        <h2>Events</h2>
        <?php if ($this->events) { ?>
            <table class="events-table">
                <thead>
                <tr>
                    <td>Event Date</td>
                    <td>Event Start</td>
                    <td>Event End</td>
                    <td>Total Time</td>
                    <td>Total Points</td>
                    <td>VIEW</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->events as $key => $event) { ?>
                        <tr>
                            <td><?= htmlentities($event->date); ?></td>
                            <td><?= htmlentities($event->start); ?></td>
                            <td><?= htmlentities($event->end); ?></td>
                            <td><?= htmlentities($event->total_time); ?></td>
                            <td><?= htmlentities($event->total_points); ?></td>
                            <td><a href="<?= Config::get('URL') . 'event/view/' . $event->uuid; ?>">View</a></td>
                            <td><a href="<?= Config::get('URL') . 'event/edit/' . $event->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'event/delete/' . $event->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No events yet. Create some !</div>
            <?php } ?>
    <?php } else { ?>
        <p>This program does not exist.</p>
    <?php } ?>
    </div>
</div>
