<h1>Hours</h1>
<div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  					<h4 class="modal-title">New Hour</h4>
  				</div>
  				<div class="modal-body">
             <p>
                 <form method="post" action="<?php echo Config::get('URL');?>hours/create">
                     <label>New hour: </label><br/>
                     <select name="type">
                       <option value="points_granted">Points Granted</option>
                       <option value="revenue_earned">Revenue Earned</option>
                       <option value="time_hourged">Time Logged</option>
                     </select><br/>
                     <input type="date" name="date" /><br/>
                     <select name="person_id">
                       <?php if ($this->people) { ?>
                       <?php foreach($this->people as $key => $person) { ?>
                         <option value="<?= htmlentities($person->id);?>"><?= htmlentities($person->first);?> <?= htmlentities($person->last);?></option>
                       <?php }} else { ?>
                         <option>No people yet. Create some !</option>
                       <?php } ?>
                     </select><br/>                
                     <input type="time" name="start" /><br/>
                     <input type="time" name="end" /><br/>
                     <input type="text" name="event_id">            
             </p>
  				</div>
  				<div class="modal-footer">
  					<input type="submit" class="btn blue" value='Create Hours' / >
  					</form>
  					<button type="button" class="btn default" data-dismiss="modal">Close</button>
  				</div>
  			</div>
  			<!-- /.modal-content -->
  		</div>
  		<!-- /.modal-dialog -->
  	</div>
    
    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Hours</a>

    <?php if ($this->hours) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Date</td>
                <td>Person</td>
                <td>Start</td>
                <td>End</td>
                <td>Total Time</td>
                <td>Total Points</td>
                <td>Total Revenue</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->hours as $key => $hour) { ?>
                    <tr>
                        <td>
                          <?php foreach($this->events as $key => $event) { ?>
                            <?php if(htmlentities($event->id)==htmlentities($hour->event_id)){?>
                              <?= date("m/d/Y", strtotime(htmlentities($event->date))); ?>
                            <?php } ?>
                           <?php } ?>
                        </td>
                        <td>
                         <?php foreach($this->people as $key => $person) { ?>
                            <?php if(htmlentities($person->id)==htmlentities($hour->person_id)){?>
                              <?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?>
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td><?= date("h:i a", strtotime(htmlentities($hour->start))); ?></td>
                        <td><?= date("h:i a", strtotime(htmlentities($hour->end))); ?></td>
                        <td><?= htmlentities($hour->total_time); ?> Hours</td>
                        <td><?= htmlentities($hour->total_points); ?> Points</td>
                        <td>$<?= htmlentities($hour->total_revenue); ?></td>
                        <td><a href="<?= Config::get('URL') . 'hours/view/' . $hour->id; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'hours/edit/' . $hour->id; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'hours/delete/' . $hour->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No hours yet. Create some !</div>
        <?php } ?>
</div>