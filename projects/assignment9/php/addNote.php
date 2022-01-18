<?php
    include_once '../classes/DbProc.php';
    if (empty($_REQUEST['data'])) {
        $val['masterstatus'] = 'error';
        $val['msg'] = 'no data sent';
    } else {
        $data = json_decode($_REQUEST['data'],true);
        if (empty($data['note'])) {
            $val['masterstatus'] = 'error';
            $val['msg'] = 'no note sent';
        } elseif (empty($data['entryDate'])){
            $val['masterstatus'] = 'error';
            $val['msg'] = 'no date sent';        
        } 
        else {
            $val['masterstatus'] = 'success';
            $val['note'] = $data['note'];
            $val['entryDate'] = $data['entryDate'];

            // create database access handle
            $dbHandle = new DbProc();
            // insert  into database
            $dbHandle->dbEntry($val['entryDate'], $val['note']);

        }
    }
echo(json_encode($val));