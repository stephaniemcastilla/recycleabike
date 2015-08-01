<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Edit Event</h4>
			</div>
			<div class="modal-body">
         <p>
            <form method="post" action="<?php echo Config::get('URL');?>events/update">
                 <label>Edit event: </label><br/>
                 <input type="text" name="id" value="<?php echo htmlentities($this->event->id); ?>"/><br/>
                 <input type="date" name="date" value="<?php echo htmlentities($this->event->date); ?>"/><br/>
                 <input type="time" name="start" value="<?php echo htmlentities($this->event->start); ?>"/><br/>
                 <input type="time" name="end" value="<?php echo htmlentities($this->event->end); ?>"/><br/>
                 <select name="program_id">
                 <?php foreach($this->programs as $key => $value) { ?>
                     <option value="<?= htmlentities($value->id); ?>"><?= htmlentities($value->name); ?></option>
                 <?php } ?>
                 </select><br/>
                 <input type="submit" class="btn blue" value='Update Event' / >
       			 </form>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>