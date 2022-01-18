<?php
//YOU MUST WRITE THE CODE FOR THE OTHER REGULAR EXPRESSIONS TO BE USED

class Validation
{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;

	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch ($regex) {
			case "name":
				return $this->name($value);
				break;
			case "phone":
				return $this->phone($value);
				break;
			case "address":
				return $this->address($value);
				break;
			case "city":
				return $this->city($value);
				break;
			case "email":
				return $this->email($value);
				break;
			case "age":
				return $this->age($value);
				break;
			case "dob":
				return $this->dob($value);
				break;
		}
	}

	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value)
	{
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}

	private function phone($value)
	{
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}

	private function address($value)
	{
		$addressPattern = '/^\d+\s+\D+/';
		$match = preg_match($addressPattern, $value);
		return $this->setError($match);
	}

	private function email($value)
	{
		$emailPattern = '/^.+\@.+\..{1,3}$/';
		$match = preg_match($emailPattern, $value);
		return $this->setError($match);
	}

	private function city($value)
	{
		$cityPattern = '/^[a-z\s]+$/i';
		$match = preg_match($cityPattern, $value);
		return $this->setError($match);
	}
	private function age($value)
	{
		$match = (! (empty($value)));
		return $this->setError($match);
	}
	
	private function dob($value)
	{
		//$dobPattern = '/^\d{2}\/\d{2}\/\d{4}$/';
		$dobPattern = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';
		$match = preg_match($dobPattern, $value);
		return $this->setError($match);
	}
	private function setError($match)
	{
		if (!$match) {
			$this->error = true;
			return "error";
		} else {
			return "";
		}
	}
	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors()
	{
		return $this->error;
	}
}
