<?php

require_once __DIR__ . '/../model/libraryservice.class.php';
require_once __DIR__ . '/../app/database/db.class.php';

class EventController{
	
	public function index(){
        	$message = '';
		require_once __DIR__ . '/../view/main.php';
	}

	public function event($event_id){
		$ls = new LibraryService;
	    	$title = $ls->findChannel($channel_id);
		$usersList = $ls->getAllUsers();

		foreach( $usersList as $user )
			if( $_SESSION['username'] == $user->username)
				$id_user = $user->id;

		if( isset($_POST['message'] ) )
			$ls->sendMessage( $id_user, $channel_id, $_POST['message'] );

		if( isset($_POST['like'] ) )
			$ls->updateLikes( $_POST['like'] );


                $messagesList = $ls->getAllMessages($channel_id);
                require_once __DIR__ . '/../view/event.php';
        }

	public function logout(){
		$title = 'Uspjesno ste se odjavili!';
		session_unset();
        	session_destroy();
		require_once __DIR__ . '/../view/login.php';

	}
}
?>