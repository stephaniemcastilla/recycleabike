<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/components.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/css/plugins.css" />
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/css/bootstrap.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo Config::get('URL'); ?>vendor/metronic/global/scripts/metronic.js"></script>

<br>
<center><h1>View Status</h1>

<div class="timeclock" style="margin-top: 50px;">
  
  <ul class="nav nav-tabs" role="tablist" id="myTab">
    <li role="presentation" class="active"><a href="#volunteer" aria-controls="home" role="tab" data-toggle="tab">Volunteers</a></li>
    <li role="presentation"><a href="#customer" aria-controls="profile" role="tab" data-toggle="tab">Customers</a></li>
    <li role="presentation"><a href="#employee" aria-controls="messages" role="tab" data-toggle="tab">Employees</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="volunteer">
      <input value="Find by Your Volunteer Record By Last Name"/>
    </div>
    <div role="tabpanel" class="tab-pane" id="customer">
      <input value="Find by Your Customer Record By Last Name"/>
    </div>
    <div role="tabpanel" class="tab-pane" id="employee">
      <input value="Find by Your Employee Record By Last Name"/>
    </div>
  </div>

  <script>
    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    });
  </script>
  
</div>