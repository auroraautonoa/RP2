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
            $events[] = new Event ($row['id'], $row['autor'], $row['dolazi'], , $row['zanima'], $row['mjesto'], $row['kategorija'], $row['vrijeme_pocetak'], $row['vrijeme_kraj'], $row['datum_pocetak'], $row['datum_kraj'], $row['title'], $row['opis']);
    
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
}