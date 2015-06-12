<div class="container">
    <h1>Hours</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <p>
            <form method="post" action="<?php echo Config::get('URL');?>hour/create">
                <label>New hour: </label><br/>
                <select name="type">
                  <option value="points_granted">Points Granted</option>
                  <option value="revenue_earned">Revenue Earned</option>
                  <option value="time_hourged">Time Hourged</option>
                </select><br/>
                <input type="date" name="date" /><br/>
                <input type="text" name="person_id" placeholder="Person ID" /><br/>
                <input type="time" name="start" /><br/>
                <input type="time" name="end" /><br/>
                <input type="submit" value='Create this hour' autocomplete="off" />
            </form>
        </p>

        <h3>All Hours</h3>
        <?php if ($this->time) { ?>
            <table class="hour-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Hour Date</td>
                    <td>Hour Person</td>
                    <td>Hour Start</td>
                    <td>Hour End</td>
                    <td>Total Time</td>
                    <td>Total Points</td>
                    <td>Total Revenue</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->time as $key => $value) { ?>
                        <tr>
                            <td><?= htmlentities($value->uuid); ?></td>
                            <td><?= htmlentities($value->date); ?></td>
                            <td><?= htmlentities($value->person_id); ?></td>
                            <td><?= date("h:i a", strtotime(htmlentities($value->start))); ?></td>
                            <td><?= date("h:i a", strtotime(htmlentities($value->end))); ?></td>
                            <td><?= date("h:i", strtotime(htmlentities($value->total_time))); ?></td>
                            <td><?= htmlentities($value->total_points); ?></td>
                            <td>$<?= htmlentities($value->total_revenue); ?></td>
                            <td><a href="<?= Config::get('URL') . 'hour/edit/' . $value->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'hour/delete/' . $value->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No time yet. Create some !</div>
            <?php } ?>
    </div>
</div>
