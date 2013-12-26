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
        HECNEL Framework
    </div>
    <div id='headerMenu'>
        <div class='headerButton'>
            <a href='#' id='openTestingBox'>
                Testing
            </a>
        </div>
            
        <div id='testingBox'>
            <ul>
                <li><a href='<?php echo _SYSTEM_BASE_URL; ?>test1'>Test 1 - View Chunks. </a></li>
                <li><a href='<?php echo _SYSTEM_BASE_URL; ?>test2'>Test 2 - Form and Inputs. </a></li>
                <li><a href='<?php echo _SYSTEM_BASE_URL; ?>test3'>Test 3</a></li>
                <li><a href='<?php echo _SYSTEM_BASE_URL; ?>test4'>Test 4</a></li>
                <li><a href='<?php echo _SYSTEM_BASE_URL; ?>test5'>Test 5</a></li>
            </ul>
        </div>

        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>help'>
                Go Help
            </a>
        </div>

        <div class='headerButton'>
            <a href='<?php echo _SYSTEM_BASE_URL; ?>releaseLog'>
                Release Log
            </a>
        </div>

<?php if ($this->userLogin == TRUE AND ($this->userRole == 'superadmin')):?>
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
