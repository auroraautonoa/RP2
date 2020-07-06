<?php
    class Event{
        protected $id, $autor, $dolazi, $zanima, $mjesto, $kategorija, $vrijeme_pocetak, 
                    $vrijeme_kraj, $datum_pocetak, $datum_kraj, $naslov, $opis;

        public function __construct ($id, $autor, $dolazi, $zanima, $mjesto, $kategorija, 
                $vrijeme_pocetak, $vrijeme_kraj, $datum_pocetak, $datum_kraj, $naslov, $opis){
            $this->id = $id;
            $this->autor = $autor;
            $this->dolazi = $dolazi;
            $this->zanima = $zanima;
            $this->mjesto = $mjesto;
            $this->kategorija = $kategorija;
            $this->vrijeme_pocetak = $vrijeme_pocetak;
            $this->vrijeme_kraj = $vrijeme_kraj;
            $this->datum_pocetak = $datum_pocetak;
            $this->datum_kraj = $datum_kraj;
            $this->naslov = $naslov;
            $this->opis = $opis;
        }

        public function __get( $property ){
            if( property_exists( $this, $property ) )
                return $this->$property; 
        }
    
        public function __set( $property, $value ){
            if( property_exists( $this, $property ) )
                $this->$property = $value;

            return $this;
        }
    }
?>