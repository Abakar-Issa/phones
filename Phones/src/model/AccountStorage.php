<?php
interface AccountStorage {

	public function checkAuth($login);
	public function createUser(Account $user);
}
	
?>