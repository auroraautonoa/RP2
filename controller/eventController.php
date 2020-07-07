<?php

require_once __DIR__ . '/../model/eventservice.class.php';
require_once __DIR__ . '/../app/database/db.class.php';

class EventController{
	
	public function index(){
        	$message = '';
		require_once __DIR__ . '/../view/main.php';
	}

	public function event($event_id){
		$ls = new EventService;
	    	$title = $ls->getEventTitle($event_id);
		$userListTemp = $ls->getAllUsers();
		$commentList = $ls->getAllComments($event_id);
		$userList = array();
		foreach( $commentList as $comment ){
			foreach( $userListTemp as $user ){
				if( $comment->id_user == $user->id ){
					array_push( $userList, $user->username );
				}
			}
		}

		if( isset($_POST['message'] ) ){
			$ls->sendMessage( $_SESSION['username'], $event_id, $_POST['message'] );
		}

                require_once __DIR__ . '/../view/event.php';
        }

	public function logout(){
		$message = 'Uspjesno ste se odjavili!';
		session_unset();
        	session_destroy();
		require_once __DIR__ . '/../view/prijava.php';
	}

	public function show_events(){
		$ls = new EventService;
		$eventList = $ls->getAllEvents();
		require_once __DIR__ . '/../view/show_events.php';
	}

	public function search(){
		$ls = new EventService;
		$eventList = $ls->getAllEventsBySearch($_POST['search']);
		require_once __DIR__ . '/../view/show_searched_events.php';
	}

}
?>