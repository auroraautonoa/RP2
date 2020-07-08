<?php

require __DIR__ . '/../app/database/db.class.php';
require __DIR__ . '/user.class.php';
require __DIR__ . '/event.class.php';
require __DIR__ . '/comment.class.php';

class EventService{
    public function getAllEvents(){
        $events = [];

        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM events' );
        $st->execute();

        while ($row = $st->fetch())
            $events[] = new Event ($row['id'], $row['id_user'], $row['dolazi'], $row['mjesto'], $row['kategorija'], $row['vrijeme_pocetak'], $row['vrijeme_kraj'], $row['datum_pocetak'], $row['datum_kraj'], $row['title'], $row['opis']);
    
        return $events;
    }

    public function getAllUsers(){
        $users = [];

        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM users');
        $st->execute();
        while( $row = $st->fetch() ){
            $users[] = new User($row['id'], $row['name'], $row['surname'], $row['username'], $row['email'], $row['password'], $row['registered_sequence'], $row['registered'], $row['admin']);
	}
        
        return $users;
    }

    public function getAllComments($id_event){
        $comments = [];

        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM komentari WHERE id_event=:id_event ORDER BY vrijeme_objave');
        $st->execute(['id_event' => $id_event]);

        while ($row = $st->fetch())
            $comments[] = new Comment($row['id'], $row['id_user'], $row['id_event'], $row['opis'], $row['zvjezdice'], $row['vrijeme_objave']);
    
        return $comments;
    }

    public function getEventTitle($id_event){
        $db = DB::getConnection();
		$st = $db->prepare('SELECT * FROM events WHERE id=:id_event');
        $st->execute(['id_event' => $id_event]);
        
        $row = $st->fetch();

        return $row['title'];
    }

    public function sendComment($id_user, $id_event, $comment, $zvjezdice){
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s', time());
        $db = DB::getConnection();
        $st = $db->prepare( 'INSERT INTO komentari(id_user, id_event, vrijeme_objave, opis, zvjezdice) VALUES (:id_user, :id_event, :vrijeme_objave, :opis, :zvjezdice)' );
        $st->execute(array('id_user' => $id_user, 'id_event' => $id_event, 'vrijeme_objave' => $date, 'opis' => $comment, 'zvjezdice' => $zvjezdice));
    }

    public function insertEvent($id_user, $dolazi, $mjesto, $kategorija, $vrijeme_pocetak, 
                    $vrijeme_kraj, $datum_pocetak, $datum_kraj, $naslov, $opis){
                        
        $db = DB::getConnection();
        $st = $db->prepare( 'INSERT INTO events(id_user, dolazi, mjesto, kategorija,
                            vrijeme_pocetak, vrijeme_kraj, datum_pocetak, datum_kraj, title, opis)
                            VALUES (:id_user, :dolazi, :mjesto, :kategorija,
                            :vrijeme_pocetak, :vrijeme_kraj, :datum_pocetak, :datum_kraj, :title, :opis)');
        $st->execute(array('id_user' => $id_user, 'dolazi' => $dolazi, 
                        'mjesto' => $mjesto, 'kategorija' => $kategorija, 'vrijeme_pocetak' => $vrijeme_pocetak,
                        'vrijeme_kraj' => $vrijeme_kraj, 'datum_pocetak' => $datum_pocetak,
                        'datum_kraj' => $datum_kraj, 'title' => $naslov, 'opis' => $opis));    
    }

    public function register($name, $surname, $username, $password, $email){
        $registration_sequence = '';
        for( $i = 0; $i < 20; ++$i )
            $registration_sequence .= chr( rand(0, 25) + ord( 'a' ) );
        
        $db = DB::getConnection();
        try{
            $st = $db->prepare('INSERT INTO users(name, surname, username, email, password, 
                            registered_sequence, registered) VALUES (:name, :surname, :username, :email, :password, :registration_sequence, 0)');
            $st->execute(array('name' => $name, 'surname' => $surname, 'username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT ), 'registration_sequence' => $registration_sequence ));
        }catch( PDOException $e ) { exit( 'PDO Error: ' . $e->getMessage() ); }
        $recipient = $email;
        $subject = 'Registracijski mail - Event Management';
        $message = 'Postovani ' . $username . '! Za dovrsetak registracije kliknite na sljedeci link: ';
        $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=' . $registration_sequence . "\n";
        $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
		            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        
        $isOK = mail($recipient , $subject, $message, $headers);  
        return $isOK;   
    }

    public function getUserByUsername($username){
        $db = DB::getConnection();
	    $st = $db->prepare('SELECT * FROM users WHERE username=:username');
        $st->execute(['username' => $username]);
        
        $row = $st->fetch();

        $user = new User($row['id'], $row['name'], $row['surname'], $row['username'], $row['email'], $row['password'], $row['registered_sequence'], $row['registered'], $row['admin']);

        return $user;
    }

    public function getIdByUsername($username){
        $db = DB::getConnection();
	    $st = $db->prepare('SELECT id FROM users WHERE username=:username');
        $st->execute(['username' => $username]);

        $row = $st->fetch();
        
        return $row['id'];
    }

    public function final_register($email){
		$value=1;
            	$db = DB::getConnection();
            	$st = $db->prepare( 'UPDATE users SET registered=? WHERE email=?' );
		$st->bindParam(1,$value);
		$st->bindParam(2,$email, PDO::PARAM_STR);
            	$st->execute();
    }

    public function getAllEventsBySearch($searched){
        $events = [];
        $db = DB::getConnection();
        $st = $db->prepare( "SELECT * FROM events WHERE title LIKE '%{$searched}%'");
        $st->execute();

        while ($row = $st->fetch())
            $events[] = new Event ($row['id'], $row['id_user'], $row['dolazi'], $row['mjesto'], $row['kategorija'], $row['vrijeme_pocetak'], $row['vrijeme_kraj'], $row['datum_pocetak'], $row['datum_kraj'], $row['title'], $row['opis']);
        return $events;
    }
    
    public function getAllCategories(){
        $categories = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT DISTINCT kategorija FROM events' );
        $st->execute();
    
        while ($row = $st->fetch()){
            $categories[] = $row['kategorija'];
        }

        return $categories;
    }

    public function getAllCities(){
        $cities = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT DISTINCT mjesto FROM events' );
        $st->execute();
    
        while ($row = $st->fetch()){
            $cities[] = $row['mjesto'];
        }

        return $cities;
    }
    
    public function getAllDates(){
        $dates = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT DISTINCT datum_pocetak FROM events' );
        $st->execute();
    
        while ($row = $st->fetch()){
            $dates[] = $row['datum_pocetak'];
        }

        return $dates;
    }

    public function getFilteredEvents($category, $city, $date, $eventList){
        if ($category != 'null'){
            for ($i = 0; $i < count($eventList); $i++){
                if ($eventList[$i]->kategorija != $category){
                    array_splice($eventList, $i, 1);
                    $i--;
                }
            }
        }

	if ($city != 'null'){
            for ($i = 0; $i < count($eventList); $i++){
                if ($eventList[$i]->mjesto != $city){
                    array_splice($eventList, $i, 1);
                    $i--;
                }
            }
        }

	if ($date != 'null'){
            for ($i = 0; $i < count($eventList); $i++){
                if ($eventList[$i]->datum_pocetak != $date){
                    array_splice($eventList, $i, 1);
                    $i--;
                }
            }
        }

        return $eventList;
    }
}