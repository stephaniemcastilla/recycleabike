<br>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'timeclock/event/' . htmlentities($this->event); ?>" style="float: left;">< Back</a></div>
<center><h1>Volunteers:</h1>

<div class="timeclock" style="margin-top: 50px;">
    
  <?php if ($this->people) { ?>
      	        
       <?php if ($this->hours) { ?>
           <table class="hours-table table table-striped table-bordered table-hover">
               <thead>
               <tr>
                   <td>Volunteer</td>
                   <td>Start Time</td>
                   <td>End Time</td>
                   <td>Total Time</td>
                   <td>Total Points</td>
               </tr>
               </thead>
               <tbody>
                   <?php foreach($this->hours as $key => $hour) { 
                     $start = strtotime(htmlentities($hour->start));
                     if ($hour->end){$end =  date("g:ia", strtotime(htmlentities($hour->end)));}else{$end="-";};
                     ?>
                     
                       <tr>
                           <?php foreach($this->people as $key => $person) { ?>
                             <?php if(htmlentities($person->id)==htmlentities($hour->person_id)){?>
                               <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
                             <?php } ?>
                           <?php } ?>
                           <td><?= date("g:ia", $start);?></td>
                           <td><?= $end;?></td>
                           <td><?= htmlentities($hour->total_time); ?></td>
                           <td><?= htmlentities($hour->total_points); ?></td>
                       </tr>
                   <?php } ?>
               </tbody>
           </table>
       <?php } else { ?>
           <div style="float: left; width: 100%; margin-top: 50px;">No volunteers signed in.</div>
       <?php } ?>

  <?php } else { ?>
      <div style="margin-top: 20px; width: 100%;">No people found.</div>
  <?php } ?>
  
</div>
