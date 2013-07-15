<div class='exception'>
    <table class="exceptionTable">
        <tbody>
            <tr class="exceptionRow">
                <td class="exceptionLabel">
                    Exception
                </td>
                <td class="exceptionValue"><?php echo $this->exception;?></td>
            </tr>
            <tr>
                <td class="exceptionLabel">
                    File
                </td>
                <td class="exceptionValue"><?php echo $this->file;?></td>
            </tr>
            <tr>
                <td class="exceptionLabel">
                    Line
                </td>
                <td class="exceptionValue"><?php echo $this->line;?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class='exceptionTrack'>
<?php foreach($this->backtrace as $backtrace): ?>
    <table class="backtraceTable">
        <tr class="backtraceRow">
            <td class="backtraceLabel">
                File
            </td>
            <td class="backtraceValue"><?php echo $backtrace['file'];?></td>
        </tr>
        <tr class="backtraceRow">
            <td class="backtraceLabel">
                Line
            </td>
            <td class="backtraceValue"><?php echo $backtrace['line'];?></td>
        </tr>
        <tr class="backtraceRow">
            <td class="backtraceLabel">
                Class
            </td>
            <td class="backtraceValue"><?php echo $backtrace['class'];?></td>
        </tr>
        <tr class="backtraceRow">
            <td class="backtraceLabel">
                Function
            </td>
            <td class="backtraceValue"><?php echo $backtrace['function'];?></td>
        </tr>
    </table>
<?php endforeach; ?>
</div>