<?php

require __DIR__ . '/../app/database/db.class.php';
require __DIR__ . '/user.class.php';
require __DIR__ . '/event.class.php';

class EventService{
    public function getAllEvents(){
        $events = [];

        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM events' );
        $st->execute();

        while ($row = $st->fetch())
            $events[] = new Event ($row['id'], $row['autor'], $row['dolazi'], $row['zanima'], $row['mjesto'], $row['kategorija'], $row['vrijeme_pocetak'], $row['vrijeme_kraj'], $row['datum_pocetak'], $row['datum_kraj'], $row['title'], $row['opis']);
    
        return $events;
    }

    public function getAllUsers(){
        $users = [];

        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM users');
        $st->execute();

        while( $row = $st->fetch() )
            $users[] = new User($row['id'], $row['name'], $row['surname'], $row['username'], $row['email'], $row['password']);
        
        return $users;
    }

    public function getAllComments($id_event){
        $comments = [];

        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM komentari WHERE id_event:=id_event ORDER BY vrijeme_objave');
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

    public function insertEvent($autor, $dolazi, $zanima, $mjesto, $kategorija, $vrijeme_pocetak, 
                    $vrijeme_kraj, $datum_pocetak, $datum_kraj, $naslov, $opis){
                        
        $db = DB::getConnection();
        $st = $db->prepare( 'INSERT INTO events(autor, dolazi, zanima, mjesto, kategorija,
                            vrijeme_pocetak, vrijeme_kraj, datum_pocetak, datum_kraj, naslov, opis)
                            VALUES (:autor, :dolazi, :zanima, :mjesto, :kategorija,
                            :vrijeme_pocetak, :vrijeme_kraj, :datum_pocetak, :datum_kraj, :naslov, :opis)');
        $st->execute(array('autor' => $autor, 'dolazi' => $dolazi, 'zanima' => $zanima, 
                        'mjesto' => $mjesto, 'kategorija' => $kategorija, 'vrijeme_pocetak' => $vrijeme_pocetak,
                        'vrijeme_kraj' => $vrijeme_kraj, 'datum_pocetak' => $datum_pocetak,
                        'datum_kraj' => $datum_kraj, 'naslov' => $naslov, 'opis' => $opis));    
}
}