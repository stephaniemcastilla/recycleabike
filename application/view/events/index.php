<div class="portlet-title">
  <h1 class="pull-left">Events</h1><a class="btn default pull-right" data-toggle="modal" href="#newevent" style="margin: 20px 0px 40px 0px;"> + Event</a>
</div>

<div class="modal fade" id="newevent" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">New Hour</h4>
			</div>
			<div class="modal-body">
         <p>
             <form method="post" action="<?php echo Config::get('URL');?>events/create">
                 <label>New event: </label><br/>
                 <select name="program_id">
                 <?php foreach($this->programs as $key => $value) { ?>
                     <option value="<?= htmlentities($value->id); ?>"><?= htmlentities($value->name); ?></option>
                 <?php } ?>
                 </select><br/>
                 <input type="date" name="date" value="<?php echo date('Y-m-d');?>"/><br/>
                 <input type="time" name="start" /><br/>
                 <input type="time" name="end" /><br/>
      
         </p>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn blue" value='Create Event' / >
				</form>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
    
<div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
  
    
    <?php if ($this->events) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Date</td>
                <td>Name</td>
                <td>Time</td>
                <td>Volunteers</td>
                <td width="150px">Actions</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->events as $key => $event) { 
                  $start = strtotime(htmlentities($event->start));
                  $end =  strtotime(htmlentities($event->end));
                  ?>
                    <tr>
                        <td><?= date("m/d/Y", strtotime(htmlentities($event->date))); ?></td>
                        <td>
                        <?php foreach($this->programs as $key => $program) { ?>
                          <?php if(htmlentities($program->id)==htmlentities($event->program_id)){?>
                            <a href="<?= Config::get('URL') . 'events/view/' . $event->id; ?>"><?= htmlentities($program->name); ?></a>
                          <?php } ?>
                        <?php } ?>
                        </td>
                        <td><?= date("g:ia", $start); echo " - "; echo date("g:ia", $end); ?></td>
                        <td>
                        <?php $count = 0;?>
                        <?php foreach($this->hours as $key => $hour) { ?>
                          <?php if(htmlentities($hour->event_id)==htmlentities($event->id)){?>
                            <?php $count = $count + 1;?>
                          <?php } ?>
                        <?php } ?>
                        <?php echo $count; ?>
                        </td>
                        <td width="150px">
                          <a class="btn btn-primary pull-right" href="<?= Config::get('URL') . 'timeclock/event/' . $event->id; ?>">Clock</a>
                          <a class="btn btn-default pull-right" href="<?= Config::get('URL') . 'events/view/' . $event->id; ?>">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No events yet. Create some !</div>
        <?php } ?>
</div>
