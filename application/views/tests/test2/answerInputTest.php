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
        Input Test Answering.
    </div>

    <div>
        <?php echo $this->response; ?>
    </div>

<?php $this->printChunk('footer'); ?>