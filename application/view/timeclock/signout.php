<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/components.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/plugins.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/css/bootstrap.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/scripts/metronic.js"></script>

<br>
<center><h1>Sign Out</h1>

<div class="timeclock" style="margin-top: 50px;">
  
  <?php if ($this->people) { ?>
  <input placeholder="Enter Your Last Name"/>
  <table style="margin-top: 20px; width: 100%;">
    <tbody>
   <?php foreach($this->people as $key => $person) { ?>
        <tr>
            <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
            <td style="text-align: right;">
              <form action="<?= Config::get('URL') . 'timeclock/signoutconfirm/'; ?>" method="post">
                <?php foreach($this->hours as $key => $hour) {
                      if (htmlentities($hour->person_id)==htmlentities($person->person_uuid)){
                        ?>
                        <input name="hour_id" type="hidden" value="<?= htmlentities($hour->hour_uuid); ?>"/>
                        <input name="hour_start" type="hidden" value="<?= htmlentities($hour->start); ?>"/>
                        <?php             
                        }
                      }
                ?>
                <input name="event_id" type="hidden" value="<?= htmlentities($this->event); ?>"/>
                <input name="person_id" type="hidden" value="<?= htmlentities($person->person_uuid); ?>"/>
                <input name="hour_type" type="hidden" value="points_granted"/>
                <input type="submit" value="Sign Out">
              </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php } else { ?>
      <div style="margin-top: 20px; width: 100%;">No one currently signed in</div>
  <?php } ?>
  
</div>