<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 26/12/13 21:30
 */
?>

<?php $this->printChunk('header'); ?>

<div>
        Test 2.
    </div>
    
    <h1>
        Correct forms.
    </h1>
    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runFormTest" method="POST">
        <div class='blockForm'>
            <p>
                <label>
                    Username. MinLength 3, MaxLength 10.
                </label>
                <label>
                    <input type="text" name="username"/>
                </label>
            </p>
    
            <p>
                <label>
                    City. MinLength 3, MaxLength 15.
                </label>
                <label>
                    <input type="text" name="city"/>
                </label>
            </p>
    
            <p>
                <label>
                    Age. Min 0, Max 120.
                </label>
                <label>
                    <input type="text" name="age"/>
                </label>
            </p>
    
            <p>
                <label>
                    Negative integer. Min -100. Max -1.
                </label>
                <label>
                    <input type="text" name="negative"/>
                </label>
            </p>

            <p>
                <label>
                    Mail address. Min Length 6. Max Length 20.
                </label>
                <label>
                    <input type="text" name="mail"/>
                </label>
            </p>

            <p>
                <label>
                    Did you read the conditions?
                </label>
                <label>
                    <input type="checkbox" name="conditions"/>
                </label>
            </p>

            <p>
                <label>
                    Do you like dogs?
                </label>
                <label>
                    <select name='dogs'>
                        <option value='1'>Yes, I do.</option>
                        <option value='2'>No, it's monday.</option>
                        <option value='paws'>Depends on the amount of paws.</option>
                        <option value='flying'>Only flying ones.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    Which day(s) of the week you like?
                </label>
                <label>
                    <select multiple name='days[]'>
                        <option value='md'>The dawn of a new week, the Monday</option>
                        <option value='td'>After a storm the sun shines brighter, TUESDAY!</option>
                        <option value='wd'>Between hell and heaven, Wednesday is cool</option>
                        <option value='th'>At Thursday I already can smell the weekend...</option>
                        <option value='fd'>FRIDAY</option>
                        <option value='st'>Saturday Party day.</option>
                        <option value='sn'>The lazy day, Sunday.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    When you think Dr.Robotnik will die? 
                </label>
                <label>
                    <input type='text' name='death' />
                </label>
            </p>
    
            <p>
                <label>
                    <input type="submit" value='Input Form' />
                </label>
            </p>
        </div>
    </form>
    
    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runInputTest" method="POST">
        <div class='blockInput'>
            <p>
                <label>
                    Username. MinLength 3, MaxLength 10.
                </label>
                <label>
                    <input type="text" name="username"/>
                </label>
            </p>
    
            <p>
                <label>
                    City. MinLength 3, MaxLength 15.
                </label>
                <label>
                    <input type="text" name="city"/>
                </label>
            </p>
    
            <p>
                <label>
                    Age. Min 0, Max 120.
                </label>
                <label>
                    <input type="text" name="age"/>
                </label>
            </p>
    
            <p>
                <label>
                    Negative integer. Min -100. Max -1.
                </label>
                <label>
                    <input type="text" name="negative"/>
                </label>
            </p>

            <p>
                <label>
                    Mail address. Min Length 6. Max Length 20.
                </label>
                <label>
                    <input type="text" name="mail"/>
                </label>
            </p>

            <p>
                <label>
                    Did you read the conditions?
                </label>
                <label>
                    <input type="checkbox" name="conditions"/>
                </label>
            </p>

            <p>
                <label>
                    Do you like dogs?
                </label>
                <label>
                    <select name='dogs'>
                        <option value='1'>Yes, I do.</option>
                        <option value='2'>No, it's monday.</option>
                        <option value='paws'>Depends on the amount of paws.</option>
                        <option value='flying'>Only flying ones.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    Which day(s) of the week you like?
                </label>
                <label>
                    <select multiple name='days[]'>
                        <option value='md'>The dawn of a new week, the Monday</option>
                        <option value='td'>After a storm the sun shines brighter, TUESDAY!</option>
                        <option value='wd'>Between hell and heaven, Wednesday is cool</option>
                        <option value='th'>At Thursday I already can smell the weekend...</option>
                        <option value='fd'>FRIDAY</option>
                        <option value='st'>Saturday Party day.</option>
                        <option value='sn'>The lazy day, Sunday.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    When you think Dr.Robotnik will die?
                </label>
                <label>
                    <input type='text' name='death' />
                </label>
            </p>
    
            <p>
                <label>
                    <input type="submit" value='Input Test' />
                </label>
            </p>
        </div>
    </form>
    
    
    <h1>
        Incorrect forms.
    </h1>
    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runFormTest" method="POST">
        <div class='blockForm'>
            <p>
                <label>
                    Username. MinLength 3, MaxLength 10.
                </label>
                <label>
                    <input type="text" name="failusername"/>
                </label>
            </p>
    
            <p>
                <label>
                    City. MinLength 3, MaxLength 15.
                </label>
                <label>
                    <input type="text" name="failcity"/>
                </label>
            </p>
    
            <p>
                <label>
                    Age. Min 0, Max 120.
                </label>
                <label>
                    <input type="text" name="failage"/>
                </label>
            </p>
    
            <p>
                <label>
                    Negative integer. Min -100. Max -1.
                </label>
                <label>
                    <input type="text" name="failnegative"/>
                </label>
            </p>

            <p>
                <label>
                    Mail address. Min Length 6. Max Length 20.
                </label>
                <label>
                    <input type="text" name="failmail"/>
                </label>
            </p>

            <p>
                <label>
                    Did you read the conditions?
                </label>
                <label>
                    <input type="checkbox" name="failconditions"/>
                </label>
            </p>

            <p>
                <label>
                    Do you like dogs?
                </label>
                <label>
                    <select name='dogs'>
                        <option value='1'>Yes, I do.</option>
                        <option value='2'>No, it's monday.</option>
                        <option value='paws'>Depends on the amount of paws.</option>
                        <option value='failflying'>Only flying ones.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    Which day(s) of the week you like?
                </label>
                <label>
                    <select multiple name='faildays[]'>
                        <option value='md'>The dawn of a new week, the Monday</option>
                        <option value='td'>After a storm the sun shines brighter, TUESDAY!</option>
                        <option value='wd'>Between hell and heaven, Wednesday is cool</option>
                        <option value='th'>At Thursday I already can smell the weekend...</option>
                        <option value='fd'>FRIDAY</option>
                        <option value='st'>Saturday Party day.</option>
                        <option value='sn'>The lazy day, Sunday.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    When you think Dr.Robotnik will die?
                </label>
                <label>
                    <input type='text' name='faildeath' />
                </label>
            </p>
    
            <p>
                <label>
                    <input type="submit" value='Input Form' />
                </label>
            </p>
        </div>
    </form>

    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runInputTest" method="POST">
        <div class='blockInput'>
            <p>
                <label>
                    Username. MinLength 3, MaxLength 10.
                </label>
                <label>
                    <input type="text" name="failusername"/>
                </label>
            </p>
    
            <p>
                <label>
                    City. MinLength 3, MaxLength 15.
                </label>
                <label>
                    <input type="text" name="failcity"/>
                </label>
            </p>
    
            <p>
                <label>
                    Age. Min 0, Max 120.
                </label>
                <label>
                    <input type="text" name="failage"/>
                </label>
            </p>
    
            <p>
                <label>
                    Negative integer. Min -100. Max -1.
                </label>
                <label>
                    <input type="text" name="failnegative"/>
                </label>
            </p>
    
            <p>
                <label>
                    Mail address. Min Length 6. Max Length 20.
                </label>
                <label>
                    <input type="text" name="failmail"/>
                </label>
            </p>

            <p>
                <label>
                    Did you read the conditions?
                </label>
                <label>
                    <input type="checkbox" name="failconditions"/>
                </label>
            </p>

            <p>
                <label>
                    Do you like dogs?
                </label>
                <label>
                    <select name='faildogs'>
                        <option value='1'>Yes, I do.</option>
                        <option value='2'>No, it's monday.</option>
                        <option value='paws'>Depends on the amount of paws.</option>
                        <option value='flying'>Only flying ones.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    Which day(s) of the week you like?
                </label>
                <label>
                    <select multiple name='faildays[]'>
                        <option value='md'>The dawn of a new week, the Monday</option>
                        <option value='td'>After a storm the sun shines brighter, TUESDAY!</option>
                        <option value='wd'>Between hell and heaven, Wednesday is cool</option>
                        <option value='th'>At Thursday I already can smell the weekend...</option>
                        <option value='fd'>FRIDAY</option>
                        <option value='st'>Saturday Party day.</option>
                        <option value='sn'>The lazy day, Sunday.</option>
                    </select>
                </label>
            </p>

            <p>
                <label>
                    When you think Dr.Robotnik will die?
                </label>
                <label>
                    <input type='text' name='faildeath' />
                </label>
            </p>
    
            <p>
                <label>
                    <input type="submit" value='Input Test' />
                </label>
            </p>
        </div>
    </form>

    <div>
        <h1>Required tests</h1>

        <h3>
            Form tests
        </h3>
        <ul>
            <li>
                No errors.
            </li>
            <li>
                Missing Inputs.
            </li>
            <li>
                Text Input empty.
            </li>
            <li>
                Text Input rule breaking - Min Length not fulfilled.
            </li>
            <li>
                Int Input empty
            </li>
            <li>
                Int Input not an integer
            </li>
            <li>
                Int Input rule breaking - Min not reached.
            </li>
        </ul>

        <h3>
            Input tests
        </h3>
        <ul>
            <li>
                No errors.
            </li>
            <li>
                Missing Inputs.
            </li>
            <li>
                Text Input empty.
            </li>
            <li>
                Text Input rule breaking - Min Length not fulfilled.
            </li>
            <li>
                Int Input empty
            </li>
            <li>
                Int Input not an integer
            </li>
            <li>
                Int Input rule breaking - Min not reached.
            </li>
        </ul>

        <h1>
            Additional tests for specific Inputs
        </h1>

        <h3>
            Input Text
        </h3>
        <ul>
            <li>
                Max Length
            </li>
            <li>
                Min Length
            </li>
        </ul>

        <h3>
            Input Number
        </h3>
        <ul>
            <li>
                Max
            </li>
            <li>
                Min
            </li>
            <li>
                is Integer
            </li>
        </ul>

        <h3>
            Input Mail
        </h3>
        <ul>
            <li>
                Mail address check
            </li>
            <li>
                Max Length
            </li>
            <li>
                Min Length
            </li>
        </ul>

        <h3>
            Input Checkbox
        </h3>
        <ul>
            <li>
                Check if enabled.
            </li>
            <li>
                Check if disabled.
            </li>
            <li>
                Check if an unexpected value is sent instead of 'on'.
            </li>
        </ul>

        <h3>
            Input Select
        </h3>
        <ul>
            <li>
                Check if available option is selected.
            </li>
            <li>
                Check if unavailable option is selected.
            </li>
            <li>
                Check if nothing is sent.
            </li>
            <li>
                Check if multiple options are selected (by front manipulation)
            </li>
        </ul>

    </div>

<?php $this->printChunk('footer'); ?>