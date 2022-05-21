<?php

//require_once("lib/ObjectFileDB.php");
require_once("model/Phone.php");
require_once("model/PhoneStorage.php");


class PhoneStorageFile implements PhoneStorage{

	private $db;

	//CONSTRUCTEUR
	public function __construct($file) {
        $this->db = new ObjectFileDB($file);
    }


    //reinit
    public function reinit(){
        $this->db->insert(new Phone ('Samsung Galaxy J4 CORE','Samsung','Galaxy J4 CORE','SmartPhone','Android','France','2018','180','16','1','3300','6','gris, bleu, noir'));
        $this->db->insert(new Phone ('iPhone Galaxy s6','iPhone','Galaxy s6','SmartPhone','iOS','États-Unis','2015','300','32','3','2600','7','noir, gris'));
        $this->db->insert(new Phone ('Huawei p30 Pro','Huawei','p30 Pro','SmartPhone','iOS','États-Unis','2019','530','4200','256','8','6','rouge, rose, bleu, noir'));
    }

    //read
    public function read($id) {
        if ($this->db->exists($id)) {
            return $this->db->fetch($id);
        } else {
            return null;
        }
    }

    //readAll
    public function readAll() {
        return $this->db->fetchAll();
    }

    //create
    public function create(Phone $p){
        return $this->db->insert($p);
    }

    //delete
    public function delete($id) {
        if ($this->db->exists($id)) {
            $this->db->delete($id);
            return true;
        }
        return false;
    }

    //update
    public function update($id, Phone $p) {
        if ($this->db->exists($id)) {
            $this->db->update($id, $p);
            return true;
        }
        return false;
    }

}
























?>