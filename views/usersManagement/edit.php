<h2>
    Edit User : <?php echo $this->userName;?>
</h2>

<form action='<?php echo BASE_URL;?>usersManagement/saveUser' method="post">
    <input type='hidden' name='userId' value='<?php echo $this->userId;?>'/>

    <p>
        <label>
            User Name
        </label>
        <input type='text' name='userName' value='<?php echo $this->userName;?>'/>
    </p>

    <p>
        <label>
            Password
        </label>
        <input type='password' name='password' value=''/>
    </p>

    <p>
        <label>
            Current Role: <?php echo $this->userRole;?>
        </label>
        <select name='userRole'>
            <option value='admin'>
                Admin
            </option>
            <option value='basic'>
                Basic
            </option>
        </select>
    </p>

    <label>
        <input type='submit' />
    </label>
</form>