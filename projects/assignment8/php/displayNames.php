<?php
    //write the code for displaying the names when the "Display Names" button is clicked here.
    include_once '../classes/DbProc.php';
    $val['masterstatus'] = 'success';
    $dbHandle = new DbProc();
    $allNameStr = $dbHandle->getNames();
    
    $val['names'] = $allNameStr;
    echo (json_encode($val));