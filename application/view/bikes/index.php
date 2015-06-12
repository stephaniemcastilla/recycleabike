<h1>All <?= ucwords(str_replace("_", " ", htmlentities($this->type))); ?> </h1>
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
                 <form method="post" action="<?php echo Config::get('URL');?>bikes/create" enctype="multipart/form-data">
                     <label>New bike: </label><br/>
                     <input type="file" name="photo"/><br/>
                     <input type="text" name="make" placeholder="Make"/><br/>
                     <input type="text" name="model" placeholder="Model"/><br/>
                     <input type="text" name="color" placeholder="Color"/><br/>
                     <input type="text" name="price" placeholder="Price"/><br/>
                     <input type="text" name="serial" placeholder="Serial"/><br/>
                     <select name="statis">
                       <option value="For Sale">
                          For Sale
                       </option>
                       <option value="In Progress">
                           In Progress
                        </option>
                        <option value="For Sold">
                            Sold
                         </option>
                     </select></br>
                     <input type="text" name="source" placeholder="Source"/><br/>
                     <input type="text" name="mechanic" placeholder="Mechanic"/><br/>
                     <input type="date" name="date_in"/><br/>
                     <input type="date" name="date_out"/><br/>      
               </p>
    				</div>
    				<div class="modal-footer">
    					<input type="submit" class="btn blue" value='Create Bike' / >
    					</form>
    					<button type="button" class="btn default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    			<!-- /.modal-content -->
    		</div>
    		<!-- /.modal-dialog -->
    	</div>
    
      <a class="btn default" data-toggle="modal" href="#basic" style="float: right; margin-bottom: 25px;"> + Bike </a>
      <?php if ($this->bikes) { ?>
          <table class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                  <td>ID</td>
                  <td>Photo</td>
                  <td>Make</td>
                  <td>Model</td>
                  <td>Color</td>
                  <td>Price</td>
                  <td>Serial</td>
                  <td>Status</td>
                  <td>Source</td>
                  <td>Mechanic</td>
                  <td>Date In</td>
                  <td>Date Out</td>
                  <td>VIEW</td>
                  <td>EDIT</td>
                  <td>DELETE</td>
              </tr>
              </thead>
              <tbody>
                  <?php foreach($this->bikes as $key => $value) { ?>
                      <tr>
                          <td><?= htmlentities($value->id); ?></td>
                          <td><img src="<?= Config::get('URL') . htmlentities($value->photo); ?>" width="50px"/></td>
                          <td><?= htmlentities($value->make); ?></td>
                          <td><?= htmlentities($value->model); ?></td>
                          <td><?= htmlentities($value->color); ?></td>
                          <td><?= htmlentities($value->price); ?></td>
                          <td><?= htmlentities($value->serial); ?></td>
                          <td><?= htmlentities($value->status); ?></td>
                          <td><?= htmlentities($value->source); ?></td>
                          <td><?= htmlentities($value->mechanic); ?></td>
                          <td><?= htmlentities($value->date_in); ?></td>
                          <td><?= htmlentities($value->date_out); ?></td>
                          <td><a href="<?= Config::get('URL') . 'bikes/view/' . $value->uuid; ?>">View</a></td>
                          <td><a href="<?= Config::get('URL') . 'bikes/edit/' . $value->uuid; ?>">Edit</a></td>
                          <td><a href="<?= Config::get('URL') . 'bikes/delete/' . $value->uuid; ?>">Delete</a></td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
          <?php } else { ?>
              <div>No <?= str_replace("_", " ", htmlentities($this->type)); ?> bikes yet. Create some !</div>
          <?php } ?>
  </div>