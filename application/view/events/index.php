<h1>Schedule</h1>
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
                 <form method="post" action="<?php echo Config::get('URL');?>events/create">
                     <label>New event: </label><br/>
                     <input type="date" name="date" /><br/>
                     <input type="time" name="start" /><br/>
                     <input type="time" name="end" /><br/>
                     <select name="program_id">
                     <?php foreach($this->programs as $key => $value) { ?>
                         <option value="<?= htmlentities($value->uuid); ?>"><?= htmlentities($value->name); ?></option>
                     <?php } ?>
                     </select><br/>          
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
  
    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Event</a>
    <?php if ($this->events) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Date</td>
                <td>Program</td>
                <td>Time</td>
                <td>Volunteers</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->events as $key => $event) { 
                  $start = strtotime(htmlentities($event->start));
                  $end =  strtotime(htmlentities($event->end));
                  ?>
                    <tr>
                        <td><?= date("m/d/Y", strtotime(htmlentities($event->date))); ?></td>
                        <?php foreach($this->programs as $key => $program) { ?>
                          <?php if(htmlentities($program->uuid)==htmlentities($event->program_id)){?>
                            <td><?= htmlentities($program->name); ?></td>
                          <?php } ?>
                        <?php } ?>
                        <td><?= date("g:ia", $start); echo " - "; echo date("g:ia", $end); ?></td>
                        <td></td>
                        <td><a href="<?= Config::get('URL') . 'events/view/' . $event->uuid; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'events/edit/' . $event->uuid; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'events/delete/' . $event->uuid; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No events yet. Create some !</div>
        <?php } ?>
</div>
