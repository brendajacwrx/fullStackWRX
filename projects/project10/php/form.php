<?php   
    // WRITE YOUR CODE HERE
    require_once('classes/StickyForm.php');
    $stickyForm = new StickyForm();
    
    $page = null;

    // called once on page load when page is null
    function init($elementsArr){
        global $page;
        $page = "form";
        return ["", getForm($elementsArr)];
    }
// creates form for input
    function getForm($elementsArr)
    {
        global $stickyForm;
        $options = $stickyForm->createOptions($elementsArr);
        $form = <<<HTML
        <form method="post" action="">
        <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="name">Name (letters only) 
                    <span class="error space ">{$elementsArr['name']['errorOutput']}</span>
                </label>
                <input type="text" class="form-control" name="name" id="name" size = 50 maxlength=20 
                value="{$elementsArr['name']['value']}" >
            </div>	
        </div>
        <div class="w-100 p-1 form-row">
            <div class="w-100 p-1 form-group">
                <label for="address">Address 
                    <span class="error space ">{$elementsArr['address']['errorOutput']}</span>
                </label>
                <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="{$elementsArr['address']['value']}">
            </div>	
            </div>
            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="city">City 
                    <span class="error space ">{$elementsArr['city']['errorOutput']}</span></label>
                <input type="text" class="form-control" name="city" id="city" 
                value="{$elementsArr['city']['value']}">
            </div>	
            </div>
            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="state">State</label>
                <select name="state" id="state" class="form-control">
                    $options;
                </select>
            </div>	
            </div>
            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="phone">Phone 
                    <span class="error space ">{$elementsArr['phone']['errorOutput']}</span></label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="999.999.999" 
                value="{$elementsArr['phone']['value']}" >
            </div>	
            </div>
            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="email">Email 
                    <span class="error space ">{$elementsArr['email']['errorOutput']}</span></label>
                <input type="email" class="form-control" name="email" id="email"
                    placeholder="kamelaharris@thewhithehouse.com example" value="{$elementsArr['email']['value']}" >
            </div>	
            </div>
            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <label for="dob">Date of birth 
                    <span class="error space ">{$elementsArr['dob']['errorOutput']}</span></label>
                <!-- <input type="date" min="1900-01-01" max="2018-12-31" class="form-control" id="DOB" value="1990-08-18"> -->
                <input type="date" min="1900-01-01" max="2018-12-31" class="form-control" name="dob" id="dob" 
                value="{$elementsArr['dob']['value']}">
            </div>	
            </div>

            <div class="form-row">
            <div class="w-100 p-1 form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="contact[]" id="c1" 
                    value="c1" {$elementsArr['contact']['status']['c1']} >
                    <label class="form-check-label" for="c1">Newsletter</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="contact[]" id="c2" value="c2" {$elementsArr['contact']['status']['c2']} >
                    <label class="form-check-label" for="c2">Email updates</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox"  name="contact[]" id="c3" value="c3" {$elementsArr['contact']['status']['c3']} >
                    <label class="form-check-label" for="c3">Text updates</label>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-check form-check-inline">
                <div>Your age: <span class="error space ">{$elementsArr['age']['errorOutput']}</span></div>
                <input class="form-check-input" type="radio" name="age" id="age1" value="age1" 
                {$elementsArr['age']['value']['age1']}>
                <label class="form-check-label" for="age1">10-18</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="age" id="age2" value="age2" 
                {$elementsArr['age']['value']['age2']} >
                <label class="form-check-label" for="age2">19-30</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="age" id="age3" value="age3" 
                {$elementsArr['age']['value']['age3']}>
                <label class="form-check-label" for="age3">31-50</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="age" id="age4" value="age4" 
                {$elementsArr['age']['value']['age4']}>
                <label class="form-check-label" for="age4">51+</label>
            </div>
        </div>
        </div>

        <button name="submit" id="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
HTML;

        return $form;
    }

    //converts age value to the label text range
    function getAge($ageVar)
        {
        switch ($ageVar) {
            case 'age1':
                # code...
                $ageRange = '10-18';
                break;

            case 'age2':
                # code...
                $ageRange = '19-30';
                break;

            case 'age3':
                # code...
                $ageRange = '31-50';
                break;

            case 'age4':
                # code...
                $ageRange = '51+';
                break;

            default:
                # code...
                $ageRange = 'too young!';
                break;
        }
        return $ageRange;
    }

    // converts time proper time
    function convertTime($t){
        return(date('Y-m-d', strtotime($t)));
    }
    function getContacts($postArr){
        $c1 = 0;
        $c2 = 0;
        $c3= 0;
        if(! empty($postArr['contact'])){
            foreach ($postArr['contact'] as $contactType) {
                # code...
                switch ($contactType) {
                    case 'c1':
                        # code...
                        $c1= 1;
                        break;
                    case 'c2':
                        # code...
                        $c2= 2;
                        break;
                    case 'c3':
                        # code...
                        $c3= 3;
                        break;
                            
                    default:
                        # code...
                        break;
                }
            }
        } 
        return [$c1, $c2, $c3];

    }
    // adds validated data to database
    function addData($postArr){
        require_once('classes/DbProc.php');
        $dbHandle = new DbProc();   
        $arr = []; 
        $arr[] = $postArr['name'];
        $arr[] = $postArr['address'];
        $arr[] = $postArr['city'];
        $arr[] = $postArr['state'];
        $arr[] = $postArr['phone'];
        $arr[] = $postArr['email'];
        $arr[] = convertTime($postArr['dob']); //2018-12-13
        $cArr = [];
        $cArr = getContacts($postArr);
        $arr[] =$cArr[0];
        $arr[] = $cArr[1];        
        $arr[] = $cArr[2];
        $arr[] = getAge($postArr['age']);
        $sql = "INSERT INTO final_project (name, address, city, state, phone, email, dob, c1, c2, c3, age)";
        $sql .=  "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $dbHandle->execute($sql, false, $arr);
         return;
    }
    
    function checkForm($postArr, $elementsArr){
        global $stickyForm;
        $validatedArr = $stickyForm->validateForm($postArr, $elementsArr);
        
        if($validatedArr['masterStatus']['status'] == "noerrors"){
      
            /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
            addData($postArr);
            return ["Contact Information Added", getForm($validatedArr)];
      
          }
          else{
            /* IF THERE WAS A PROBLEM WITH OUT FORM VALIDATION THEN THE MODIFIED ARRAY ($POSTARR) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
            return ["", getForm($validatedArr)];
          }

    }