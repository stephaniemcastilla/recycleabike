<?php if ($this->event) { ?>

<div class="portlet-title">
  
  <h1 class="pull-left"><a href="/events">< </a><?= htmlentities($this->program->name); echo ": "; echo date("m/d/Y", strtotime(htmlentities($this->event->date))); ?></h1>
  <a class="btn default pull-right" data-toggle="modal" href="#editevent" style="margin: 20px 0px 40px 0px;"> Edit Event</a>
</div>

<div class="modal fade" id="editevent" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Edit Event</h4>
			</div>
			<div class="modal-body">
         <p>
            <form method="post" action="<?php echo Config::get('URL');?>events/update">
                 <label>Edit event: </label><br>
                 <select name="program_id">
                 <?php foreach($this->programs as $key => $value) { ?>
                     <option value="<?= htmlentities($value->id); ?>" <?php if(htmlentities($value->id)==htmlentities($this->program->id)){echo 'selected';}?>><?= htmlentities($value->name); ?></option>
                 <?php } ?>
                 </select><br><br>
                 <input type="hidden" name="id" value="<?php echo htmlentities($this->event->id); ?>"/><br/>
                 <input type="date" name="date" value="<?php echo htmlentities($this->event->date); ?>"/><br/>
                 <input type="time" name="start" value="<?php echo htmlentities($this->event->start); ?>"/><br/>
                 <input type="time" name="end" value="<?php echo htmlentities($this->event->end); ?>"/><br/>
                 <input type="submit" class="btn blue" value='Update Event' / >
       			 </form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
            
<div class="modal fade" id="newhour" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Volunteer</h4>
			</div>
			<div class="modal-body">
         <p>
           <a href="<?= Config::get('URL') . 'events/delete/' . $event->id; ?>">Delete</a>
           
             <form method="post" action="<?php echo Config::get('URL');?>hours/create">
                 <label>Select Volunteer: </label><br/>
                 <input type="hidden" name="type" value="points_granted">
                 <input type="hidden" name="date" value="<?= htmlentities($this->event->date);?>"/><br/>
                 <select name="id">
                   <?php if ($this->people) { ?>
                   <?php foreach($this->people as $key => $person) { ?>
                     <option value="<?= htmlentities($person->id);?>"><?= htmlentities($person->first);?> <?= htmlentities($person->last);?></option>
                   <?php }} else { ?>
                     <option>No people yet. Create some !</option>
                   <?php } ?>
                 </select><br/>                
                 <input type="time" name="start" class="form-control timepicker timepicker-no-seconds"/><br/>
                 <input type="time" name="end" class="form-control timepicker timepicker-no-seconds"/><br/>
                 <input type="hidden" name="event_id" value="<?= htmlentities($this->event->id);?>">            
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
    
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    
    <div class="portlet-subtitle">
      <h2 class="pull-left">Volunteers</h2><a class="btn default pull-right" data-toggle="modal" href="#newhour" style="margin: 20px 0px 40px 0px;"> + Volunteer</a>
    </div>
  	        
        <?php if ($this->hours) { ?>
            <table class="hours-table table table-striped table-bordered table-hover">
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
                    <?php foreach($this->hours as $key => $hour) { 
                      $start = strtotime(htmlentities($hour->start));
                      $end =  strtotime(htmlentities($hour->end));
                      ?>
                      
                        <tr>
                            <?php foreach($this->people as $key => $person) { ?>
                              <?php if(htmlentities($person->id)==htmlentities($hour->person_id)){?>
                                <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
                              <?php } ?>
                            <?php } ?>
                            <td><?= date("g:ia", $start);?></td>
                            <td><?= date("g:ia", $end);?></td>
                            <td><?= htmlentities($hour->total_time); ?></td>
                            <td><?= htmlentities($hour->total_points); ?></td>
                            <td><a href="<?= Config::get('URL') . 'hours/edit/' . $hour->id; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'hours/delete/' . $hour->id; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No volunteers logged for this event.</div>
        <?php } ?>

<?php } else { ?>
    <p>This event does not exist.</p>
<?php } ?>