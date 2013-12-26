<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 12/12/13 23:45
 */
?>

<?php $this->printChunk('header'); ?>

    <h1>
        Test 1
    </h1>

    <div>
        In this page you can see the power of this amazing View engine! <br/>
        For setting a View you have to do the following: <br/>
        <ul>
            <li>
                Tell the controller which is the main view. To do this you have to request to the view...
                <div class='code'>
                    <&#63;php $this->_view->addChunk('main', 'Relative Path from View folder'); &#63;>
                </div>
            </li>
            <li>
                Set other chunks you want to use in that view, in the controller as well. Do it this way!
                <div class='code'>
                    <&#63; php $this->_view->addChunk('randomNameYouWantToUse', 'myPage/myFile'); &#63;>
                </div>
            </li>
            <li>
                Now, in the main view you specified first, you can print the loaded views. This way -->
                <div class='code'>
                    <&#63; php $this->printChunk('randomNameYouWantToUse'); &#63;>
                </div>
            </li>
            <li>
                That was it. Easy, huh?
            </li>
        </ul>
    </div>

<?php $this->printChunk('index1'); ?>
<?php $this->printChunk('index2'); ?>
<?php $this->printChunk('index3'); ?>
<?php $this->printChunk('index4'); ?>
<?php $this->printChunk('index5'); ?>

<?php $this->printChunk('footer'); ?>