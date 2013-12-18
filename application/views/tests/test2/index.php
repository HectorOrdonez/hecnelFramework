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
    
    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runFormTest" method="POST">
        <label>
            Checkbox Test
        </label>
        <label>
            <input type="checkbox" name="checkboxTest"/>
        </label>
        <label>
            randomstuff Test
        </label>
        <label>
            <input type="text" name="username"/>
        </label>
        <label>
            <input type="text" name="city"/>
        </label>
        <label>
            <input type="submit" value='Form Test'/>
        </label>
    </form>
    
    <form action="<?php echo _SYSTEM_BASE_URL; ?>test2/runInputTest" method="POST">
        <label>
            Checkbox Test
        </label>
        <label>
            <input type="checkbox" name="checkboxTest"/>
        </label>
        <label>
            randomstuff Test
        </label>
        <label>
            <input type="text" name="username"/>
        </label>
        <label>
            <input type="text" name="city"/>
        </label>
        <label>
            <input type="submit" value='Input Test' />
        </label>
    </form>
