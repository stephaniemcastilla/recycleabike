<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/components.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/plugins.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/css/bootstrap.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/scripts/metronic.js"></script>

<br>
<center><h1>Sign In</h1>

<div class="timeclock" style="margin-top: 50px;">
  
  <input placeholder="Enter Your Last Name" onkeyup="autofill(<?php echo $event_id;?>)"/>
  <?php if ($this->people) { ?>
  <table style="margin-top: 20px; width: 100%;">
    <tbody>
   <?php foreach($this->people as $key => $person) { ?>
        <tr>
            <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
            <td style="text-align: right;">
              <form action="<?= Config::get('URL') . 'timeclock/signinconfirm/'; ?>" method="post">
                <input name="event_id" type="hidden" value="<?= htmlentities($this->event); ?>"/>
                <input name="person_id" type="hidden" value="<?= htmlentities($person->person_uuid); ?>"/>
                <input type="submit" value="Sign In">
              </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php } else { ?>
      <div style="margin-top: 20px; width: 100%;">No people found.</div>
  <?php } ?>
  
</div>
