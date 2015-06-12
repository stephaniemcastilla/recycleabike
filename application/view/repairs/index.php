<div class="container">
    <h1>Repairs</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <p>
            <form method="post" action="<?php echo Config::get('URL');?>repairs/create">
                <label>New repair: </label><br/>
                <input type="text" name="id" placeholder="ID"/><br/>
                <select name="hour_id">
                  <?php if ($this->hours) { ?>
                  <?php foreach($this->hours as $key => $hour) { ?>
                    <option value="<?= htmlentities($hour->uuid);?>"><?= htmlentities($hour->uuid);?></option>
                  <?php }} else { ?>
                    <option>No hours yet. Create some !</option>
                  <?php } ?>
                </select>
                <select name="person_id">
                  <?php if ($this->people) { ?>
                  <?php foreach($this->people as $key => $person) { ?>
                    <option value="<?= htmlentities($person->uuid);?>"><?= htmlentities($person->first);?> <?= htmlentities($person->last);?></option>
                  <?php }} else { ?>
                    <option>No bikes yet. Create some !</option>
                  <?php } ?>
                </select>
                <select name="bike_id">
                  <?php if ($this->bikes) { ?>
                  <?php foreach($this->bikes as $key => $bike) { ?>
                    <option value="<?= htmlentities($bike->uuid);?>"><?= htmlentities($bike->make);?> <?= htmlentities($bike->model);?></option>
                  <?php }} else { ?>
                    <option>No bikes yet. Create some !</option>
                  <?php } ?>
                </select>
                <input type="submit" value='Create this repair' autocomplete="off" />
            </form>
        </p>

        <?php if ($this->repairs) { ?>
            <table class="repair-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Repair Name</td>
                    <td>VIEW</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->repairs as $key => $value) { ?>
                        <tr>
                            <td><?= htmlentities($value->uuid); ?></td>
                            <td><?= htmlentities($value->name); ?></td>
                            <td><a href="<?= Config::get('URL') . 'repairs/view/' . $value->uuid; ?>">View</a></td>
                            <td><a href="<?= Config::get('URL') . 'repairs/edit/' . $value->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'repairs/delete/' . $value->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No repairs yet. Create some !</div>
            <?php } ?>
    </div>
</div>
