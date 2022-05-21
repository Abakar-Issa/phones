<?php
require_once('model/PhoneStorage.php');

class PhoneStorageStub implements PhoneStorage{

  private $phonesTab;
  private $db;

  //CONSTRUCTEUR
	public function __construct(){
    	$this->phonesTab  = array( 
    			new Phone ('Samsung Galaxy J4 CORE','Samsung','Galaxy J4 CORE','SmartPhone','Android','France','2018','180','16','1','3300','6','gris, bleu, noir'),
       	 	new Phone ('iPhone Galaxy s6','iPhone','Galaxy s6','SmartPhone','iOS','États-Unis','2015','300','32','3','2600','7','noir, gris'),
        	new Phone ('Huawei p30 Pro','Huawei','p30 Pro','SmartPhone','iOS','États-Unis','2019','530','4200','256','8','6','rouge, rose, bleu, noir')
          );
      
  }

  //read
  public function read($id){
    for($i=0;$i<count($this->phonesTab);$i++){
      if($this->phonesTab[$i]->getNom()==$id){
          return $this->phonesTab[$i];
      }
    }
    return null;
  }

  //readAll
  public function readAll(){
    $t = array();
    for($i=0;$i<count($this->phonesTab);$i++){
      $t[$this->phonesTab[$i]->getNom()] = $this->phonesTab[$i];
    }
    return $t;
  }

  //create
  public function create(Phone $p){
    return $this->db->insert($p);
  }

  //delete
  public function delete($id){
    if ($this->db->exists($id)){
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