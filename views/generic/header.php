<!doctype html>
<html>
<head>
    <title>
        <?php echo $this->title; ?>

    </title>

    <?php foreach ($this->css as $css) : ?><link rel='stylesheet' href='<?php echo $css; ?>' />
    <?php endforeach; ?>

    <?php foreach ($this->js as $js) : ?><script src='<?php echo $js; ?>'></script>
    <?php endforeach; ?>

</head>
<body>

<div id='header'>
    HEC FRAMEWORK Header
    <br />
    <a href='<?php echo BASE_URL; ?>index'>
        Go Index
    </a>
    |
    <a href='<?php echo BASE_URL; ?>help'>
        Go Help
    </a>
    |
    <a href='<?php echo BASE_URL; ?>about'>
        About this
    </a>
    |
    <?php if (Session::get('isUserLoggedIn') == TRUE):?><a href='<?php echo BASE_URL; ?>dashboard/logout'>
        Logout
    </a><?php else: ?><a href='<?php echo BASE_URL; ?>login'>
        Login
    </a>
    <?php endif; ?>
</div>
<hr />

<!-- Opening Content -->
<div id='content'>
