<?php
class Kunde{
    private $lastname;
    private $firstname;
    private $adress;
    private $id;
    private $user_id;
    private $email;
    private $passwort;


    public function setLastname($inhalt){
        $this->lastname = $inhalt;
    }
    public function getLastname(){
        return $this->lastname;
    }


    public function setFirstname($inhalt){
        $this->firstname = $inhalt;
    }
    public function getFirstname(){
        return $this->firstname;
    }


    public function setAdress($inhalt){
        $this->adress = $inhalt;
    }
    public function getAdress(){
        return $this->adress;
    }


    public function setMail($inhalt){
        $this->email = $inhalt;
    }
    public function getMail(){
        return $this->email;
    }

    //TODO HASH
    public function setPasswort($inhalt){
        $this->passwort = $inhalt;
    }
    public function getPasswort(){
        return $this->passwort;
    }


    public function setUserId($handle){
        $befehl = "SELECT COUNT(user_id) FROM users";
        $rueckgabe = $handle->query($befehl);
        $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);

        if ($ergebnis[0]['COUNT(user_id)'] == 0) {
            $this->user_id = 1;
        } else {
            $befehl2 = "SELECT MAX(user_id) FROM users";
            $rueckgabe2 = $handle->query($befehl2);
            $ergebnis2 = $rueckgabe2->fetchAll(PDO::FETCH_ASSOC);
            $nr = $ergebnis2[0]['MAX(user_id)'] + 1;
            $this->user_id = $nr;
        }
    }
    public function getUserId(){
        return $this->user_id;
    }
}
