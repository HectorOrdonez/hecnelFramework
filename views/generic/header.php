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
    <div id='mainTitle'>
        HEC Framework
    </div>

    <div id='headerMenu'>
        <div class='headerButton'>
            <a href='<?php echo BASE_URL; ?>index'>
                Go Index
            </a>
        </div>
        <div class='headerButton'>
            <a href='<?php echo BASE_URL; ?>help'>
                Go Help
            </a>
        </div>
        <div class='headerButton'>
            <a href='<?php echo BASE_URL; ?>about'>
                About this
            </a>
        </div>
        <div class='headerButton'>
            <?php if (Session::get('isUserLoggedIn') == TRUE):?><a href='<?php echo BASE_URL; ?>dashboard/logout'>
                    Logout
                </a><?php else: ?><a href='<?php echo BASE_URL; ?>login'>
                    Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class='separation_1'></div>

<!-- Opening Content -->
<div id='content'>
