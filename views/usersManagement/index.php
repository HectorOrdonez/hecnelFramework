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
    </tr>
    <?php endforeach; ?>
</table>

<h2>
    Add new user
</h2>

<form action='<?php echo BASE_URL;?>usersManagement/createUser' method="post">
    <label>
        User Name
    </label>
    <input type='text' name='userName' />

    <label>
        Password
    </label>
    <input type='password' name='password' />

    <label>
        Role
    </label>
    <select name='userRole'>
        <option value='admin'>
            Admin
        </option>
        <option checked='checked' value='basic'>
            Basic
        </option>
    </select>

    <label>
        <input type='submit' />
    </label>
</form>