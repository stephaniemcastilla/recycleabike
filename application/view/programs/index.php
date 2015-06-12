<h1>Programs</h1>
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
               <form method="post" action="<?php echo Config::get('URL');?>programs/create">
                   <label>New program: </label><br/>
                   <input type="text" name="id" placeholder="ID"/><br/>
                   <input type="text" name="name" placeholder="Name"/><br/>        
             </p>
  				</div>
  				<div class="modal-footer">
  					<input type="submit" class="btn blue" value='Create Program' / >
  					</form>
  					<button type="button" class="btn default" data-dismiss="modal">Close</button>
  				</div>
  			</div>
  			<!-- /.modal-content -->
  		</div>
  		<!-- /.modal-dialog -->
  	</div>

    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Program </a>
    <?php if ($this->programs) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Program Name</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->programs as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->name); ?></td>
                        <td><a href="<?= Config::get('URL') . 'programs/view/' . $value->uuid; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'programs/edit/' . $value->uuid; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'programs/delete/' . $value->uuid; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No programs yet. Create some !</div>
        <?php } ?>
</div>