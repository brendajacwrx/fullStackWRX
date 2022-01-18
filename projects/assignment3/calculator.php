<?php
    /*
        Author: Brenda J Anderson

        Purpose: The purpose of this class is to calculate either addition,
        subtraction, multiplication or division  on two entered integers.

        Pre: 
            $oprs=[]; // legal operators
            $operand1; // legal operand 1
            $operand2; // legal operand 2

            $err_msgs = []; // error messages for display
            $success_msgs = []; // success messages for display

            Post: Result of aplied $opr on $operand1 and $operand2 or error message

        Functional Requirements:  
            1. Validate the first entry is an $opr, the second entry is
            $operand1, and the third is $operand2, and insure they are integers.
            2. All successful entryies generate separate success messages.
            3. Errors display separate error messages.
            4. The script runs in a browser where results will display upon
             submitting the script.

    */
    class Calculator{

        private $oprs=[]; // legal operators
        private $operand1; // legal operand 1
        private $operand2; // legal operand 2

        private $err_msgs = []; // error messages for display
        private $success_msgs = []; // success messages for display

        //SETTERS
        public function setOperand1($int1){
            $this->operand1=$int1;
        }   

        public function setOperand2($int1){
            $this->operand2=$int1;
        }   
        
        //GETTERS
        public function getOperand1(){
            return $this->operand1;
        }

        public function getOperand2(){
            return $this->operand2;
        }

        /*
            Pre: arguments passed $int1 and $int2
            Post: returns the sum of the arguments passed

        */
        private function add($int1, $int2){
            return ($int1 + $int2);
        }
        

        /*
            Pre: arguments passed $int1 and $int2
            Post: returns the difference of arguments passed

        */
        private function subtract($int1, $int2){
            return ($int1 - $int2);
        }

        /*
            Pre: arguments passed $int1 and $int2
            Post: returns the product of arguments passed

        */
        private function multiply($int1, $int2){
            return ($int1 * $int2);
        }

        
        /*
            Pre: arguments passed $int1 and $int2
            Post: returns the division of arguments passed

        */
        private function divide($int1, $int2){
            return ($int1 / $int2);
        }

        public function __construct(){ 
            $this->oprs = ['+','-','*','/'];

            $this->err_msgs[] = "The only valid operators are '+ - * /' "; 
            $this->err_msgs[] =  "You cannot divide by zero! ";
            $this->err_msgs[] =  "You must enter a string and two integers ";

            $this->success_msgs['sum'] =  "The sum of the numbers is ";
            $this->success_msgs['diff'] =  "The difference of the numbers is ";
            $this->success_msgs['prod'] =  "The product of the numbers is ";
            $this->success_msgs['div'] =  "The division of the numbers is ";
        }

        public function calc(string $opr, $int1 = null, $int2 = null){
            //check for required variables and types           
            if(( is_string($opr ) && (!(is_null($int1)) && !(is_null($int2))))){
                // check if operands are numerica and cast to ints if so
                if(is_numeric($int1) && is_numeric($int2)){
                    $this->setOperand1((int)$int1);
                    $this->setOperand2((int)$int2);
                    //if $opr is in $oprs, good operator
                    if(in_array ( $opr , $this->oprs) ){
                        // perform calculation based on $opr
                        switch ($opr) {
                            case $this->oprs[0]:
                            echo('<p class="text-success">'.$this->success_msgs['sum'].$this->add($this->operand1, $this->operand2).'</p>' );
                            break;
                            case $this->oprs[1]:
                            echo('<p class="text-success">'.$this->success_msgs['diff'].$this->subtract($this->operand1,$this->operand2).'</p>' );
                            break;
                            case $this->oprs[2]:
                            echo('<p class="text-success">'.$this->success_msgs['prod'].$this->multiply($this->operand1, $this->operand2).'</p>' );
                            break;
                            case $this->oprs[3]:
                                // if $opr is division and $this->operand2 equal zero display error messge
                                if(($opr === $this->oprs[3]) && ($this->operand2 === 0)){
                                    echo('<p class="text-danger font-weight-bolder">'.$this->err_msgs[1].'</p>');
                                } else if($opr === $this->oprs[3]) {
                                    echo('<p class="text-success">'.$this->success_msgs['div'].$this->divide($this->operand1, $this->operand2).'</p>' );                            
                                }
                                break;                        
                            default:
                                break;
                        }
                    } else { 
                        // output error message of invalid operator
                        echo('<p class="text-danger font-weight-bolder">'.$this->err_msgs[0].'</p>');
                    }
                } else {
                    // just return if non-numeric operands
                    return;
                }
            } else {
                //display error message of required string
                echo('<p class="text-danger font-weight-bolder">'.$this->err_msgs[2].'</p>');
            }
        }
    }
?>