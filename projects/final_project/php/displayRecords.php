<?php
    require_once('classes/DbProc.php');
    // process data to display records

    // deciphers contact information request
    function contactResults($c1, $c2, $c3)
    {
        $contactArr = [];
        if (strcmp($c1, '1') === 0) {
            $contactArr[] = 'Newsletter';
        }
        if (strcmp($c2, '2') === 0) {
            $contactArr[] = 'Email updates';
        }
        if (strcmp($c3, '3') === 0) {
            $contactArr[] = 'Text updates';
        }
        $numContacts = count($contactArr);
        $str = null;
        if ($numContacts === 0) {
            return $str;
        } else {
            $tbl = <<<HTML
                    <table>
                HTML;
            for ($i = 0; $i < $numContacts; $i++) {
                # code...
                $tbl .= '<tr class="p-0 m-0"><td>' . $contactArr[$i] . '</td></tr>';
            }
            $tbl .= '</table>';
            return $tbl;
        }


        return $str;
    }

    //returns the table of data from the database
    function getTable($message=null)
    {
        
        $dbHandle = new DbProc();
        $sql = 'SELECT * FROM final_project';
        //get results
        $results = $dbHandle->execute($sql, true);
        $table = null;
        if (!empty($results)) {
            $table  = <<<HTML
                <h2>Contact Information</h2>
                <form method="post" action="">
                <button name="delete" id="delete" type="submit" class="btn btn-danger">Delete</button>
                    <table class="table table-striped w-100"><thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Contacts</th>
                    <th scope="col">Age</th>                
                    <th scope="col">&nbsp;</th>
                    </tr></thead>
                        <tbody>
    HTML;
            foreach ($results  as $result) {
                $table .= '<tr>';
                $table .= '<td>' . $result['name'] . '</td>';
                $table .= '<td>' . $result['address'] . '</td>';
                $table .= '<td>' . $result['phone'] . '</td>';
                $table .= '<td>' . $result['email'] . '</td>';
                $table .= '<td>' . $result['dob'] . '</td>';
                $table .=  '<td>';
                $table .= contactResults($result['c1'], $result['c2'], $result['c3']);
                $table .= '</td>';
                $table .= '<td>' . $result['age'] . '</td>';
                $table .= '<td>';
                $table .= '<div class="form-group">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="deleteChk[]" id="deleteChk" 
            value="' . $result['final_project_id'] . '" >
        </div>';
                $table .= '</td>';
                $table  .= '</td>';
            }
            $table .= '</tbody></table></form>';

            return [$message, $table];
        } else {
            return ['No data available.', ''];
        }
    }

    // deletes contacts from database and redisplays table
    function deleteContacts($post)
    {
        
        $success = false;
        $message = null;
        if (isset($post['deleteChk'])) {
            foreach ($post['deleteChk'] as $id) {
                $dbHandle = new DbProc();
                $sql = "DELETE FROM final_project WHERE final_project_id=(?)";
                $arr = [];
                $arr[] = $id;
                //delete contact
                $result = $dbHandle->execute($sql, false, $arr);
                if (empty($result)) {
                    $success = true;
                }
            }
            if ($success) {
                $message = 'All checked contact(s) deleted';
            } else {
                $message = 'There was an error in deleting a contact or contacts';
            }
        } else {
            $message = 'No contact(s) selected to delete';
        }
        return getTable($message);
    }

    ?>