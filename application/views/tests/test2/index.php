<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 12/12/13 23:45
 */
?>
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

    </div>