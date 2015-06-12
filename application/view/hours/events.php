<div class="container">
    <h1>Events</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <p>
            <form method="post" action="<?php echo Config::get('URL');?>log/create">
                <label>New log: </label><br/>
                <select name="type">
                  <option value="points_granted">Points Granted</option>
                  <option value="revenue_earned">Revenue Earned</option>
                  <option value="time_logged">Time Logged</option>
                </select><br/>
                <input type="date" name="date" /><br/>
                <input type="text" name="person_id" placeholder="Person ID" /><br/>
                <input type="time" name="start" /><br/>
                <input type="time" name="end" /><br/>
                <input type="submit" value='Create this log' autocomplete="off" />
            </form>
        </p>

        <h3>All Logs</h3>
        <?php if ($this->events) { ?>
            <table class="event-table">
                <thead>
                <tr>
                    <td>Event Date</td>
                    <td>Event Start</td>
                    <td>Event End</td>
                    <td>Total Time</td>
                    <td>Total Points</td>
                    <td>Total Revenue</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->events as $key => $value) { ?>
                        <tr>
                            <td><?= htmlentities($value->date); ?></td>
                            <td><?= date("h:i a", strtotime(htmlentities($value->start))); ?></td>
                            <td><?= date("h:i a", strtotime(htmlentities($value->end))); ?></td>
                            <td><a href="<?= Config::get('URL') . 'log/timebyevent/' . $value->uuid; ?>"><?= date("h:i", strtotime(htmlentities($value->total_time))); ?></a></td>
                            <td><?= htmlentities($value->total_points); ?></td>
                            <td>$<?= htmlentities($value->total_revenue); ?></td>
                            <td><a href="<?= Config::get('URL') . 'log/edit/' . $value->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'log/delete/' . $value->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No events yet. Create some !</div>
            <?php } ?>
    </div>
</div>
