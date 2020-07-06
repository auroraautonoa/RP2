<?php

//require_once __DIR__ . '/../model/libraryservice.class.php';
require_once __DIR__ . '/../app/database/db.class.php';

class LoginController{
	
	public function index(){
		require_once __DIR__ . '/../view/main.php';
	}

	public function try_login(){
        if( isset( $_POST['txtUsername'] ) && isset( $_POST['txtPassword'] ) ){
			$password =$_POST['txtPassword'];
			$passed = false;
			/*$ls = new LibraryService;
			$userList = $ls->getUsersByUsername( $_POST['username'] );
			foreach ( $userList as $user ){
				if(password_verify($password, $user->password)){
					if($user->registered){
						$message = 'Dobrodosli '.$user->username;
						$channelList = $ls->getChannelsByUser($_POST['username']);
						require_once __DIR__ . '/../view/main.php';
						$passed = true;
						break;
					}
					else{
						$message = 'Verifikacija preko email-a nije izvrsena!';
						require_once __DIR__ . '/../view/prijava.php';
					}
				}
			}*/
			if(!$passed){
				$message = 'Pogresan username ili password !';
				require_once __DIR__ . '/../view/prijava.php';
			}
        }
	else{
		$message = 'ERROR 404';
		require_once __DIR__ . '/../view/prijava.php';
	}
    	}
	
	public function login(){
		$message = '';
		require_once __DIR__ . '/../view/prijava.php';
	}

	public function register(){
		$message = '';
		require_once __DIR__ . '/../view/registracija.php';
	}

	public function try_register(){
        if( isset( $_POST['txtIme'] ) && isset( $_POST['txtPrezime'] ) && isset( $_POST['txtUsername'] ) && isset( $_POST['txtPassword'] ) && isset( $_POST['txtEmail'] ) ){
			$pattern = "/^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$";
			if( !preg_match($pattern,$_POST['txtIme']) ){
				$message = 'Pogresno ime!';
				require_once __DIR__ . '/../view/registracija.php';
				exit(0);
			}
			if( !preg_match($pattern,$_POST['txtPrezime']) ){
				$message = 'Pogresno prezime!';
				require_once __DIR__ . '/../view/registracija.php';
				exit(0);
			}
			$pattern = "/^[a-z0-9_-]{3,15}$/i";
			if( !preg_match($pattern,$_POST['username']) ){
				$title = 'Pogresan username! Unesite 3-15 znakova!';
				require_once __DIR__ . '/../view/registracija.php';
				exit(0);
			}
			$pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/i";
			if( !preg_match($pattern,$_POST['email']) ){
				$title = 'Pogresna email adresa!';
				require_once __DIR__ . '/../view/registracija.php';
				exit(0);
			}
			$pattern = "/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/i";
			if( !preg_match($pattern,$_POST['password']) ){
				$title = 'Pogresan password! Unesite najmanje 8 znakova( bar jedno slovo i bar jedan broj )!';
				require_once __DIR__ . '/../view/registracija.php';
				exit(0);
			}
			/*$ls = new LibraryService;
			$userList = $ls->getAllUsers();
			foreach($userList as $user){
				if( $user->username == $_POST['username'] ){
					$title = 'Username vec postoji!';
					require_once __DIR__ . '/../view/registracija.php';
					exit(0);
				}
				if( $user->email == $_POST['email'] ){
					$title = 'Email adresa vec iskoristena!';
					require_once __DIR__ . '/../view/registracija.php';
					exit(0);
				}
			}
			$suc = $ls->register($_POST['username'], $_POST['password'], $_POST['email']);
			if(!$suc){
				$title = "Greska u slanju mail-a!";
				require_once __DIR__ . '/../view/register.php';
				exit(0);
			}*/
			$message = 'Za dovrsetak registracije pritisnite na link koji smo Vam poslali na vasu email adresu (moguce u spam folderu).';
			require_once __DIR__ . '/../view/prijava.php';
        }
        else{
            $message = 'Greska!';
            require_once __DIR__ . '/../view/registracija.php';
        }
    }

	public function logout(){
		$title = 'Uspjesno ste se odjavili!';
		session_unset();
        	session_destroy();
		require_once __DIR__ . '/../view/login.php';

	}

	public function show_events(){
		$ls = new EventService;
		$eventList = $ls->getAllEvents();
		require_once __DIR__ . '/../view/show_events.php';
	}
}
?>