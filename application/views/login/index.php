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

<h1>
    Login
</h1>

<form action="<?php echo _SYSTEM_BASE_URL;?>login/run" method="POST">
    <label>
        Login
    </label>
    <label>
        <input type="text" name="name"/>
    </label>
    <label>
        Password
    </label>
    <label>
        <input type="password" name="password"/>
    </label>
    <label>
        <input type="submit" />
    </label>
</form>

<?php $this->printChunk('footer'); ?>