<br>
<div style="margin: 0px 230px;"><a href="<?= Config::get('URL') . 'timeclock/event/' . htmlentities($this->event); ?>" style="float: left;">< Back</a></div>
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
                      if (htmlentities($hour->person_id)==htmlentities($person->id)){
                        ?>
                        <input name="hour_id" type="hidden" value="<?= htmlentities($hour->id); ?>"/>
                        <input name="hour_start" type="hidden" value="<?= htmlentities($hour->start); ?>"/>
                        <input name="hour_mode" type="hidden" value="<?= htmlentities($hour->mode); ?>"/>
                        <?php             
                        }
                      }
                ?>
                <input name="event_id" type="hidden" value="<?= htmlentities($this->event); ?>"/>
                <input name="person_id" type="hidden" value="<?= htmlentities($person->id); ?>"/>
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