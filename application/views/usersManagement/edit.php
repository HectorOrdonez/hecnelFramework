<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 26/12/13 21:30
 */
?>

<?php $this->printChunk('header'); ?>

<h2>
    Edit User : <?php echo $this->userName;?>
</h2>

<form action='<?php echo _SYSTEM_BASE_URL;?>usersManagement/editUser' method="post">
    <input type='hidden' name='userId' value='<?php echo $this->userId;?>'/>

    <p>
        <label>
            User Name
        </label>
        <label>
            <input type='text' name='userName' value='<?php echo $this->userName;?>'/>
        </label>
    </p>

    <p>
        <label>
            Password
        </label>
        <label>
            <input type='password' name='password' value=''/>
        </label>
    </p>

    <p>
        <label>
            Current Role: <?php echo $this->userRole;?>
        </label>
        <label>
            <select name='userRole'>
                <option value='admin'>
                    Admin
                </option>
                <option value='basic'>
                    Basic
                </option>
            </select>
        </label>
    </p>

    <label>
        <input type='submit' />
    </label>
</form>

<?php $this->printChunk('footer'); ?>