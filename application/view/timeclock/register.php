<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />

Register

<form method="post" action="<?php echo Config::get('URL');?>people/create">
  <input type="hidden" name="location" value="timeclock"/>
  <input type="hidden" name="event" value="<?= $event; ?>"/>
  <input type="file" name="photo" value=""/>
  <input type="text" name="first" placeholder="First Name" value=""/>
  <input type="text" name="last" placeholder="Last Name" value=""/>
  <input type="text" name="email" placeholder="Email Address" value=""/>
  <input type="text" name="phone" placeholder="Phone Number" value=""/>
  <input type="submit" value="Save Registration">
</form>