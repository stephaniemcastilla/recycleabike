<div class="container">
    <h1></h1>

    <div class="box">
        <h2>Edit Bike</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->bike) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>bikes/update" enctype="multipart/form-data">
                <label>Change text of bike: </label>
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="uuid" value="<?php echo htmlentities($this->bike->uuid); ?>" /><br/>
                <input type="file" name="photo"/><br/>
                <input type="text" name="make" placeholder="Make" value="<?php echo htmlentities($this->bike->make); ?>" /><br/>
                <input type="text" name="model" placeholder="Model" value="<?php echo htmlentities($this->bike->model); ?>" /><br/>
                <input type="text" name="color" placeholder="Color" value="<?php echo htmlentities($this->bike->color); ?>" /><br/>
                <input type="text" name="price" placeholder="Price" value="<?php echo htmlentities($this->bike->price); ?>" /><br/>
                <input type="text" name="serial" placeholder="Serial" value="<?php echo htmlentities($this->bike->serial); ?>" /><br/>
                <input type="text" name="photo" placeholder="Photo" value="<?php echo htmlentities($this->bike->photo); ?>" /><br/>
                <input type="text" name="source" placeholder="Source" value="<?php echo htmlentities($this->bike->source); ?>" /><br/>
                <input type="text" name="mechanic" placeholder="Mechanic" value="<?php echo htmlentities($this->bike->mechanic); ?>" /><br/>
                <input type="text" name="status" placeholder="Status" value="<?php echo htmlentities($this->bike->status); ?>" /><br/>
                <input type="text" name="date_in" placeholder="Date In" value="<?php echo htmlentities($this->bike->date_in); ?>" /><br/>
                <input type="text" name="date_out" placeholder="Date Out" value="<?php echo htmlentities($this->bike->date_out); ?>" /><br/>
                <input type="submit" value='Change' />
            </form>
        <?php } else { ?>
            <p>This bike does not exist.</p>
        <?php } ?>
    </div>
</div>
