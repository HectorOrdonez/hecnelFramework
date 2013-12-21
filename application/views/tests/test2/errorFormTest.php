<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 12/12/13 23:45
 */
?>
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
