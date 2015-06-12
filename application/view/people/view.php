<div class="container">
    <?php if ($this->person) { ?>
    <h1><?= htmlentities($this->person->first); ?> <?= htmlentities($this->person->last); ?></h1>
    <div class="box">
        <h2>Details</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        
        <h2>Hours</h2>
        <?php if ($this->hours) { ?>
            <table class="hours-table">
                <thead>
                <tr>
                    <td>Date</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Total Time</td>
                    <td>Total Points</td>
                    <td>VIEW</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->hours as $key => $hour) { ?>
                        <tr>
                            <td><?= htmlentities($hour->date); ?></td>
                            <td><?= htmlentities($hour->start); ?></td>
                            <td><?= htmlentities($hour->end); ?></td>
                            <td><?= htmlentities($hour->total_time); ?></td>
                            <td><?= htmlentities($hour->total_points); ?></td>
                            <td><a href="<?= Config::get('URL') . 'hours/view/' . $hour->uuid; ?>">View</a></td>
                            <td><a href="<?= Config::get('URL') . 'hours/edit/' . $hour->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'hours/delete/' . $hour->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hours yet. Create some !</div>
            <?php } ?>
    <?php } else { ?>
        <p>This person does not exist.</p>
    <?php } ?>
    </div>
</div>
