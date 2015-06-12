<h1><?= ucwords(str_replace("_", " ", htmlentities($this->type))); ?> </h1>
<div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  					<h4 class="modal-title">New Person</h4>
  				</div>
  				<div class="modal-body">
             <p>
                 <form method="post" action="<?php echo Config::get('URL');?>people/create">
                     <input type="text" name="first" placeholder="First Name"/><br/>
                     <input type="text" name="last" placeholder="Last Name"/><br/>
                     <input type="text" name="email" placeholder="Email Address Name"/><br/>                 
             </p>
  				</div>
  				<div class="modal-footer">
  					<input type="submit" class="btn blue" value='Create Person' / >
  					</form>
  					<button type="button" class="btn default" data-dismiss="modal">Close</button>
  				</div>
  			</div>
  			<!-- /.modal-content -->
  		</div>
  		<!-- /.modal-dialog -->
  	</div>

    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Person </a>
    <?php if ($this->people) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Email</td>
                <td>Total Time</td>
                <td>Total Points</td>
                <td>Total Revenue</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->people as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->first); ?></td>
                        <td><?= htmlentities($value->last); ?></td>
                        <td><?= htmlentities($value->email); ?></td>
                        <td><?= htmlentities($value->total_time); ?> Hours</td>
                        <td><?= htmlentities($value->total_points); ?> Points</td>
                        <td>$<?= htmlentities($value->total_revenue); ?></td>
                        <td><a href="<?= Config::get('URL') . 'people/view/' . $value->person_uuid; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'people/edit/' . $value->person_uuid; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'people/delete/' . $value->person_uuid; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div>No <?= str_replace("_", " ", htmlentities($this->type)); ?> yet. Create some !</div>
    <?php } ?>

</div>