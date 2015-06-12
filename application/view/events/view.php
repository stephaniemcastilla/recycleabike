<h1><?= htmlentities($this->program->name); echo ": "; echo date("m/d/Y", strtotime(htmlentities($this->event->date))); ?></h1>

<div class="box">
    <h2>Event Details</h2>
    
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
                         <option value="<?= htmlentities($person->person_uuid);?>"><?= htmlentities($person->first);?> <?= htmlentities($person->last);?></option>
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
  	        
    <?php if ($this->event) { ?>
        <?php if ($this->hours) { ?>
            <table class="hours-table">
                <thead>
                <tr>
                    <td>Volunteer</td>
                    <td>Start Time</td>
                    <td>End Time</td>
                    <td>Total Time</td>
                    <td>Total Points</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->hours as $key => $hour) { ?>
                        <tr>
                            <?php foreach($this->people as $key => $person) { ?>
                              <?php if(htmlentities($person->person_uuid)==htmlentities($hour->person_id)){?>
                                <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
                              <?php } ?>
                            <?php } ?>
                            <td><?= htmlentities($hour->start); ?></td>
                            <td><?= htmlentities($hour->end); ?></td>
                            <td><?= htmlentities($hour->total_time); ?></td>
                            <td><?= htmlentities($hour->total_points); ?></td>
                            <td><a href="<?= Config::get('URL') . 'hour/edit/' . $hour->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'hour/delete/' . $hour->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No volunteer hours logged for this event.</div>
            <?php } ?>
    <?php } else { ?>
        <p>This event does not exist.</p>
    <?php } ?>
</div>