<?php

interface PhoneStorage {

  public function read($id);
  public function readAll();

  public function create(Phone $p);
  public function delete($id);

  public function update($id, Phone $p);

}

?>