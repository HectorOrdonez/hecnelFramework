<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 26/12/13 21:00
 */
?>
<?php $this->printChunk('header'); ?>

<div>
    <h1>
        Dashboard. Welcome <?php echo $this->userName; ?>
    </h1>
</div>

<label>
    List of Inserts
</label>
<table id=tableInserts>
</table>

<hr />

<form id='insertForm' action="<?php echo _SYSTEM_BASE_URL;?>dashboard/ajaxInsert" method="post">
    <label>
        Data
    </label>
    <label>
        <input type="text" name="data" value=""/>
    </label>
    <input type="submit" />
</form>

<?php $this->printChunk('footer'); ?>