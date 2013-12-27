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

    <div>
        <h1>
            Version <?php echo $this->getParameter('developmentVersion')['version'];?>, released <?php echo $this->getParameter('developmentVersion')['date'];?>.
        </h1>

        <ul>
        <?php foreach ($this->getParameter('developmentVersion')['changes'] as $change) : ?>
            <li>
                <?php echo $change;?>
            </li>
        <?php endforeach; ?>
        </ul>

        <hr />

        <h1>
            Historical Log
        </h1>

        <?php foreach ($this->getParameter('historicalLog') as $log) : ?>
            <h2>
                Version <?php echo $log['version']; ?>, released <?php echo $log['date']; ?>
            </h2>

            <ul>
                <?php foreach ($log['changes'] as $change) : ?>
                    <li>
                        <?php echo $change;?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>

    </div>

<?php $this->printChunk('footer'); ?>