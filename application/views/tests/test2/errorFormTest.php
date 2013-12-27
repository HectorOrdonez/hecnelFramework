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
        Form Test Error.
    </div>
    
    <div>
        <?php foreach ($this->errors as $error):?>
        <div class='error'>
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
    </div>

<?php $this->printChunk('footer'); ?>