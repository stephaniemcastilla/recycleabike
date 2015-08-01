<div class="portlet-title">
  <h1 class="pull-left">Sales</h1><a class="btn default pull-right" data-toggle="modal" href="#newevent" style="margin: 20px 0px 40px 0px;"> + Sale</a>
</div>

<div class="modal fade" id="newevent" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">New Sale</h4>
			</div>
			<div class="modal-body">
         <p>
             <form method="post" action="<?php echo Config::get('URL');?>sales/create">
                 <div style="height: 100px; float: left;">
                 Customer Name <input type="text"/>
               </div>
               <div style="height: 100px; float: left;">
               <input type="radio" name="sex" value="male">Points<br>
               <input type="radio" name="sex" value="female">Cash
             </div>
             
               <?php if ($this->parts) { ?>
                   <table class="table table-striped table-bordered table-hover">
                       <thead>
                       <tr>
                           <td>Product</td>
                           <td>Price</td>
                           <td>Points</td>
                           <td></td>
                       </tr>
                       </thead>
                       <tbody>
                           <?php foreach($this->parts as $key => $part) { ?>
                               <tr>
                                   <td><?= htmlentities($part->name); ?></td>
                                   <td>$<?= htmlentities($part->price); ?></td>
                                   <td><?= round(htmlentities($part->points), 2); ?></td>
                                   <td><div style="float:left;"class="btn btn-primary">+</div></td>
                               </tr>
                           <?php } ?>
                       </tbody>
                   </table>
               <?php } else { ?>
                   <div>No parts yet. Create some !</div>
               <?php } ?>
                   
             </form>
         </p>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn blue" value='Create Sale' / >
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
  
    
    <?php if ($this->sales) { ?>
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
                <?php foreach($this->sales as $key => $sale) { 
                  $start = strtotime(htmlentities($sale->start));
                  $end =  strtotime(htmlentities($sale->end));
                  ?>
                    <tr>
                        <td><?= date("m/d/Y", strtotime(htmlentities($sale->date))); ?></td>
                        <?php foreach($this->programs as $key => $program) { ?>
                          <?php if(htmlentities($program->uuid)==htmlentities($sale->program_id)){?>
                            <td><a href="<?= Config::get('URL') . 'sales/view/' . $sale->uuid; ?>"><?= htmlentities($program->name); ?></a></td>
                          <?php } ?>
                        <?php } ?>
                        <td><?= date("g:ia", $start); echo " - "; echo date("g:ia", $end); ?></td>
                        <td>
                        <?php $count = 0;?>
                        <?php foreach($this->hours as $key => $hour) { ?>
                          <?php if(htmlentities($hour->event_id)==htmlentities($sale->uuid)){?>
                            <?php $count = $count + 1;?>
                          <?php } ?>
                        <?php } ?>
                        <?php echo $count; ?>
                        </td>
                        <td width="150px">
                          <a class="btn btn-primary pull-right" href="<?= Config::get('URL') . 'timeclock/event/' . $sale->uuid; ?>">Clock</a>
                          <a class="btn btn-default pull-right" href="<?= Config::get('URL') . 'sales/view/' . $sale->uuid; ?>">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No sales yet. Create some !</div>
        <?php } ?>
</div>
