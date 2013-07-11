<!doctype html>
<html>
<head>
    <!-- Title -->
    <title>
        <?php echo $this->_getTitle(); ?>

    </title>

    <!-- Meta Tags -->
    <?php foreach ($this->_getMeta() as $meta) : ?><meta <?php foreach ($meta as $tagName=>$tagValue) : echo "{$tagName}='{$tagValue}' "; endforeach; ?>/>
    <?php endforeach; ?>

    <!-- CSS Stylesheets -->
    <?php foreach ($this->_getCss() as $css) : ?><link rel='stylesheet' href='<?php echo $css; ?>' />
    <?php endforeach; ?>

    <!-- JS Libraries -->
    <?php foreach ($this->_getJs() as $js) : ?><script src='<?php echo $js; ?>'></script>
    <?php endforeach; ?>

</head>
<body>

<div id='header'>
    <div id='mainTitle'>
        HEC Framework
    </div>
    <div id='headerMenu'>
        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>index'>
                Go Index
            </a>
        </div>

        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>help'>
                Go Help
            </a>
        </div>

        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>about'>
                About this
            </a>
        </div>

<?php if ($this->userLogin == TRUE AND ($this->userRole == 'owner')):?>
        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>usersManagement'>
                User Management
            </a>
        </div>
<?php endif; ?>

        <div class='headerButton'>
<?php if ($this->userLogin == TRUE):?>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>dashboard/logout'>
                Logout
            </a>
<?php else: ?>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>login'>
                Login
            </a>
<?php endif; ?>
        </div>
    </div>
</div>
<div class='separation_1'></div>

<!-- Opening Content -->
<div id='content'>
