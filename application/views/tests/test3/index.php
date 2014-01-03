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
        Test 3.
    </div>

    <h1>
        CRUD in Models ( CreateReadUpdateDelete! )
    </h1>

    <div id='triggerContainer'>
        <a href='#' id='create'>Create</a>
        <a href='#' id='read'>Read</a>
        <a href='#' id='update'>Update</a>
        <a href='#' id='delete'>Delete</a>
    </div>

    <div id='boxContainer'>

        <div class='box' id='dogModel'>
            <form action='' id='dogForm' method="POST">
                <div>
                    <label for='dogId'>
                        Id
                    </label>
                    <input name='dogId' id='dogId' type='text' />
                </div>
    
                <div>
                    <label for='dogName'>
                        Name
                    </label>
                    <input name='dogName' id='dogName' type='text' />
                </div>
    
                <div>
                    <label for='dogAge'>
                        Age
                    </label>
                    <input name='dogAge' id='dogAge' type='text' />
                </div>
    
                <div>
                    <label for='dogBreed'>
                        Breed
                    </label>
                    <select name='dogBreed' id='dogBreed'>
                        <option value='germanSheppard'>German Sheppard</option>
                        <option value='siberianHusky'>Siberian Husky</option>
                        <option value='biggles'>Biggles</option>
                        <option value='borderCollie'>Border Collie</option>
                    </select>
                </div>
            </form>
        </div>

        <div class='box' id='log'>

        </div>
    </div>

<?php $this->printChunk('footer'); ?>