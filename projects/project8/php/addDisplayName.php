<?php
//write the code for adding and displaying the names here when the "Add Name" button is clicked
//* addDisplay.php starter
include_once '../classes/DbProc.php';
if (empty($_REQUEST['data'])) {
    $val['masterstatus'] = 'error';
    $val['msg'] = 'no data sent';
} else {
    $data = json_decode($_REQUEST['data'],true);
    if (empty($data['name'])) {
        $val['masterstatus'] = 'error';
        $val['msg'] = 'no data sent';
    } else {
        $val['masterstatus'] = 'success';
        $name = $data['name'];
        //split name string into array of first and last name            
        $getName = explode(" ", $name);
        // reverse name 
        $revName = [];
        $revName[] = $getName[1];
        $revName[] = $getName[0];
        // convert array $revName to string $nameStr with comma and space
        $glue = ', ';
        $nameStr = implode ($glue, $revName);
        // create database access handle
        $dbHandle = new DbProc();
        // insert $nameStr into database
        $dbHandle->dbEntry($nameStr);
        // get all the names in database as an ordered string 
        $val['names'] = $dbHandle->getNames();
    }
}
echo(json_encode($val));