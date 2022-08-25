<?php

require_once("controller/Controller.php");

class QuestionController extends Controller {
  
  public function action($params, $model) {
		// のパスを返す
		if (isset($_SESSION['loginStatus']) == true) {
			return "view/question.php";
		} else {
			return "view/login.php";
		}	
	}
}