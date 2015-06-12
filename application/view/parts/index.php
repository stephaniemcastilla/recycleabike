<h1>Parts</h1>
<div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <p>
        <form method="post" action="<?php echo Config::get('URL');?>parts/create">
            <label>New part: </label><br/>
            <input type="text" name="id" placeholder="ID"/><br/>
            <input type="text" name="name" placeholder="Name"/><br/>
            <input type="submit" value='Create this part' autocomplete="off" />
        </form>
    </p>

    <?php if ($this->parts) { ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Id</td>
                <td>Part Name</td>
                <td>Part Model</td>
                <td>VIEW</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->parts as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->id); ?></td>
                        <td><?= htmlentities($value->name); ?></td>
                        <td><?= htmlentities($value->model); ?></td>
                        <td><a href="<?= Config::get('URL') . 'parts/view/' . $value->uuid; ?>">View</a></td>
                        <td><a href="<?= Config::get('URL') . 'parts/edit/' . $value->uuid; ?>">Edit</a></td>
                        <td><a href="<?= Config::get('URL') . 'parts/delete/' . $value->uuid; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div>No parts yet. Create some !</div>
        <?php } ?>
</div>