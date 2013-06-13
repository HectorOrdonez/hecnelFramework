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

<form id='insertForm' action="<?php echo BASE_URL;?>dashboard/ajaxInsert" method="post">
    <label>
        Data
    </label>
    <input type="text" name="data" value="" />
    <input type="submit" />
</form>