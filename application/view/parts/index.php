<h1>Parts</h1>
<div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  					<h4 class="modal-title">New Part</h4>
  				</div>
  				<div class="modal-body">
             <p>
                 <form method="post" action="<?php echo Config::get('URL');?>parts/create">
                     <label>New part: </label><br/>
                       <input type="file" name="photo"/><br/>
                      <input type="text" name="name" placeholder="name"/><br/>
                      <input type="text" name="model" placeholder="model"/><br/>
                      <input type="text" name="cost" placeholder="cost"/><br/>
                      <input type="text" name="price" placeholder="price"/><br/>
                      <input type="text" name="points" placeholder="points"/><br/>        
             </p>
  				</div>
  				<div class="modal-footer">
  					<input type="submit" class="btn blue" value='Create Part' / >
  					</form>
  					<button type="button" class="btn default" data-dismiss="modal">Close</button>
  				</div>
  			</div>
  			<!-- /.modal-content -->
  		</div>
  		<!-- /.modal-dialog -->
  	</div>
  
    <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Part</a>

    <?php if ($this->parts) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Photo</td>
                <td>Name</td>
                <td>Price</td>
                <td>Points</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->parts as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->photo); ?></td>
                        <td><?= htmlentities($value->name); ?></td>
                        <td><?= htmlentities($value->price); ?></td>
                        <td><?= htmlentities($value->points); ?></td>
                        <td><a href="<?= Config::get('URL') . 'parts/view/' . $value->id; ?>">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No parts yet. Create some !</div>
        <?php } ?>
</div>