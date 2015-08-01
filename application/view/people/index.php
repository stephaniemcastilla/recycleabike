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
                     <input type="hidden" name="type" value="<?= htmlentities($this->type)?>"/><br/>                 
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

    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + <?= ucwords(str_replace("_", " ", htmlentities($this->type))); ?> </a>
    <?php if ($this->people) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Email</td>
                <td>Points</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->people as $key => $person) { ?>
                    <tr>
                        <td><?= htmlentities($person->first); ?></td>
                        <td><?= htmlentities($person->last); ?></td>
                        <td><?= htmlentities($person->email); ?></td>
                        <td>
                          <?php $total_points = 0; ?>
                          <?php foreach($this->points as $key => $point_total) { ?>
                            <?php if(htmlentities($person->id)==htmlentities($point_total->person_id)){?>
                              <?php $total_points = round($point_total->points,0); ?>
                            <?php } ?>
                          <?php } ?>
                          <?php echo $total_points?>
                        </td>
                        <td><a href="<?= Config::get('URL') . 'people/view/' . $person->id; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'people/edit/' . $person->id; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'people/delete/' . $person->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div>No <?= str_replace("_", " ", htmlentities($this->type)); ?> yet. Create some !</div>
    <?php } ?>

</div>