<br>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'timeclock/event/' . htmlentities($this->event); ?>" style="float: left;">< Back</a></div>
<center><h1>Sign In:</h1>

<div class="timeclock" style="margin-top: 50px;">
  
  <input id="autofill" placeholder="Search by Last Name" onkeyup="autofill('<?= htmlentities($this->event); ?>');"/>
  
  <form action="<?php echo Config::get('URL'); ?>timeclock/signinconfirm/" method="post">
  <input name="event_id" type="hidden" value="<?= htmlentities($this->event); ?>"/>
  <input id="person_id" name="person_id" type="hidden" value=""/>
  <input id="mode" name="mode" type="hidden" value=""/>
  
  <?php if ($this->people) { ?>
  <table style="margin-top: 20px; width: 100%;" id="autofill-results">
    <tbody>

    </tbody>
  </table>
  <?php } else { ?>
      <div style="margin-top: 20px; width: 100%;">No people found.</div>
  <?php } ?>
  
</div>


<div class="modal fade" id="volunteer" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Sign In to Volunteer</h4>
			</div>
			<div class="modal-body">
         <p>
                          
         </p>
			</div>
			<div class="modal-footer">
				<input name="points" type="submit" class="btn blue" value='OK' / >
				<button type="button" class="btn default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="useshop" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Sign In to Use Shop</h4>
			</div>
			<div class="modal-body">
         <p>

         </p>
			</div>
			<div class="modal-footer">
				<input name="revenue" type="submit" class="btn blue" value='OK' / >
				<button type="button" class="btn default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


</form>