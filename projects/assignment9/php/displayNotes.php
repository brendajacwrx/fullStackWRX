<?php
    include_once '../classes/DbProc.php';
    if (empty($_REQUEST['data'])) {
        $val['masterstatus'] = 'error';
        $val['msg'] = 'no data sent';
    } else {
        $data = json_decode($_REQUEST['data'],true);
        if (empty($data['beginTime'])) {
            $val['masterstatus'] = 'error';
            $val['msg'] = 'no beginTime sent';
        } elseif (empty($data['endTime'])){
            $val['masterstatus'] = 'error';
            $val['msg'] = 'no endTime sent';        
        } 
        else {
            $val['masterstatus'] = 'success';
            // create database access handle
            $dbHandle = new DbProc();
            // get notes from database
            $val['beginTime'] = $data['beginTime'];
            $val['endTime'] = $data['endTime'];
            $val['notes']  = $dbHandle->getNotes($val['beginTime'], $val['endTime']);
        }
    }
    echo(json_encode($val));
