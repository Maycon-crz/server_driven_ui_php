<?php

namespace controllers;

// use BaseController;
use services\AuthBO;
// use services\lib\GenericTools;
// use dataTransferObjects\LoginDTO;
// use models\LoginModel;

// use Source\Models\Authentication\UserRegistrationModel;
// use Source\Models\Authentication\DataTransferObjects\UserRegistrationDTO;

class AuthenticationController{
	private $authBO;
	private $genericTools;
	private $loginDTO;
	private $loginModel;
	// private $userRegistrationModel;
	// private $userRegistrationDTO;
	private $response = array();
	/*constructor*/
	public function __construct(){
		$this->authBO = new AuthBO();
		// $this->genericTools = new GenericTools();
		// $this->loginDTO = new LoginDTO;
		// $this->loginModel = new LoginModel();	
		// $this->userRegistrationModel = new UserRegistrationModel();
		// $this->userRegistrationDTO = new UserRegistrationDTO();
	}
	// public function createSession(){
	// 	$this->response = $this->authBO->generateAppKey();		
	// 	// echo $this->view->render("api", [
	// 	// 	"dados" => $this->response["appkey"]
	// 	// ]);
	// }
	public function loginController(){
	// public function loginController(): void{
		// $this->loginDTO->setFrontEnd(isset($_POST["front_end"]) ? $this->genericTools->filter($_POST["front_end"]) : "");
		// $this->loginDTO->setEmail(isset($_POST["email"]) ? $this->genericTools->filter($_POST["email"]) : "");
		// $this->loginDTO->setPassword(isset($_POST["password"]) ? $this->genericTools->filter($_POST["password"]) : "");
		// $this->response = $this->loginModel->loginValidation($this->loginDTO);

		// echo $this->view->render("api", [
		// 	"dados" => $this->response
		// ]);

		// $this->successResponse("Boora!", "Success", 200);

		return "Boora";
	}
	// public function logoutController(): void{
	// 	$this->response = $this->loginModel->logOut();
	// 	// echo $this->view->render("api", [
	// 	// 	"dados" => $this->response,
	// 	// ]);
	// }
	public function userRegistrationController(): void{
		// $this->middlewareForSimpleAccess->checkAppKey($this->view);
		// $this->userRegistrationDTO->setFrontEnd(isset($_POST['front_end']) ? $this->genericTools->filter($_POST['front_end']) : "");
		// $this->userRegistrationDTO->setFullName(isset($_POST['full_name']) ? $this->genericTools->filter($_POST['full_name']) : "");
		// $this->userRegistrationDTO->setEmail(isset($_POST['email']) ? $this->genericTools->filter($_POST['email']) : "");
		// $this->userRegistrationDTO->setEmailConf(isset($_POST['email_conf']) ? $this->genericTools->filter($_POST['email_conf']) : "");
		// $this->userRegistrationDTO->setPassword(isset($_POST['password']) ? $this->genericTools->filter($_POST['password']) : "");
		// $this->userRegistrationDTO->setPasswordConf(isset($_POST['password_conf']) ? $this->genericTools->filter($_POST['password_conf']) : "");
		// $this->userRegistrationDTO->setTerms(isset($_POST['terms']) ? $this->genericTools->filter($_POST['terms']) : "");

		// $this->response = $this->userRegistrationModel->userRegistration($this->userRegistrationDTO);
		// echo $this->view->render("api", [
		// 	"dados" => $this->response,
		// ]);
	}
	public function forgotMyPasswordValidation(){}
	public function recoversPasswordValidation(){}
	public function changePassword(){}
	public function completeRegistration(){}
}