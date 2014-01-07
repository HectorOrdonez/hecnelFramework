<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 26/12/13 21:30
 * @var \application\engine\View $this
 */
?>

<?php $this->printChunk('header'); ?>

<div>
    <a href='<?php echo _SYSTEM_BASE_URL; ?>help/helpMeWith/aboutlife'>Help me with Life</a>
    <a href='<?php echo _SYSTEM_BASE_URL; ?>help/helpMeWith/aboutdeath'>Help me with Death</a>
    <a href='<?php echo _SYSTEM_BASE_URL; ?>help/helpMeWith/aboutECWGT'>Help me with Eating Cakes Without Getting Fat (ECWGF)</a>
    <a href='<?php echo _SYSTEM_BASE_URL; ?>help/helpMeWith/aboutDWWGD'>Help me with Drinking Whisky Without Getting Drunk (DWWGD)</a>
    <hr />
    <?php echo $this->getParameter('msg'); ?>
</div>

<?php $this->printChunk('footer'); ?>
