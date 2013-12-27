<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 26/12/13 21:30
 *
 * @var \application\engine\View $this
 */ ?>

<?php $this->printChunk('header'); ?>

    <div>
        Input Test got an error.
    </div>

    <div class='error'>
        <?php echo $this->error; ?>
    </div>

<?php $this->printChunk('footer'); ?>