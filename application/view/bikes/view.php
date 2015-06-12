<div class="container">
    <?php if ($this->bike) { ?>
    <h1><?= htmlentities($this->bike->make); ?> <?= htmlentities($this->bike->model); ?></h1>
    PRINT DETAILS
    <br>
    LOG SALE
    <br>
    LOG REPAIR
    <div class="box">
        <h2>Details</h2>
        Make: <?= htmlentities($this->bike->make); ?></br>
        Model: <?= htmlentities($this->bike->model); ?></br>
        Serial: <?= htmlentities($this->bike->serial); ?></br>
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        
        <h3>Repair Summary</h3>
        <?php if ($this->repairs) { ?>
            <table class="repairs-table">
                <thead>
                <tr>
                    <td>Date</td>
                    <td>Person</td>
                    <td>VIEW</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->repairs as $key => $repair) { ?>
                        <tr>
                            <?php foreach($this->hours as $key => $hour) { ?>
                                <?php if(htmlentities($hour->uuid)==htmlentities($repair->log_id)){?>
                                  <td><?= htmlentities($hour->date); ?></td>
                                <?php } ?>
                              <?php } ?>
                             <?php foreach($this->people as $key => $person) { ?>
                                <?php if(htmlentities($person->uuid)==htmlentities($repair->person_id)){?>
                                  <td><?= htmlentities($person->first); ?> <?= htmlentities($person->last); ?></td>
                                <?php } ?>
                              <?php } ?>
                            <td><a href="<?= Config::get('URL') . 'repairs/view/' . $repair->uuid; ?>">View</a></td>
                            <td><a href="<?= Config::get('URL') . 'repairs/edit/' . $repair->uuid; ?>">Edit</a></td>
                            <td><a href="<?= Config::get('URL') . 'repairs/delete/' . $repair->uuid; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>This bike has no logged repairs.</div>
            <?php } ?>
        
    <?php } else { ?>
        <p>This bike does not exist.</p>
    <?php } ?>
    </div>
</div>
