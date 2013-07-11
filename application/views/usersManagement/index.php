<h1>
    Users Management
</h1>

<h2>
    List of current users
</h2>
<table><?php foreach($this->usersList as $user): ?>

    <tr>
        <td>
            <?php echo $user['name'];?>

        </td>
        <td>
            <?php echo $user['role'];?>

        </td>
        <td>
            <a href='<?php echo _SYSTEM_BASE_URL.'usersManagement/openUserEdition/'.$user['id'];?>'>Edit</a>
        </td>
        <td>
            <a href='<?php echo _SYSTEM_BASE_URL.'usersManagement/deleteUser/'.$user['id'];?>'>Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>
    Add new user
</h2>

<form action='<?php echo _SYSTEM_BASE_URL;?>usersManagement/createUser' method="post">
    <label>
        User Name
    </label>
    <label>
        <input type='text' name='userName'/>
    </label>

    <label>
        Password
    </label>
    <label>
        <input type='password' name='password'/>
    </label>

    <label>
        Role
    </label>
    <label>
        <select name='userRole'>
            <option value='admin'>
                Admin
            </option>
            <option value='basic' selected>
                Basic
            </option>
        </select>
    </label>

    <label>
        <input type='submit' />
    </label>
</form>