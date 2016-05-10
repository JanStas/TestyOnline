<?php

/**
*
* Model_home.php 
* extends Model.php
*
* @author Mateusz Sorys
* 
*
*/

class model_ustawienia extends Model {

	public function walidacja_zmiana_hasla($post){
		// print_r($post);

		if(empty($post['stare_haslo'])|| empty($post['haslo'])||empty($post['powtorz_haslo']))
		{
			return '<div class="box-default box-eroor">Uzupełnij wszystkie pola!</div>';
			exit();
		}
		if($post['haslo'] != $post['powtorz_haslo']){
			return '<div class="box-default box-error">Hasła muszą byc takie same!</div>';
			exit;
		}

		$user_id = $_SESSION['user_id'];

		$stmt = $this->dbh->prepare("SELECT haslo FROM uzytkownicy WHERE id = :id_uzytkownika");

		$stmt->execute(array(
			':id_uzytkownika'	=> $user_id
		));

		$stare_haslo_db = $stmt->fetch()->haslo;
		$stare_haslo = md5($post['stare_haslo']);

		if ($stare_haslo != $stare_haslo_db) {
			return '<div class="box-default box-error">To nie jest prawidlowe stare haslo!</div>';
			exit;
		}

		

		$nowe_haslo = md5($post['haslo']);
		$stmt = $this->dbh->prepare("UPDATE uzytkownicy set haslo = :nowe_haslo where id= :id_uzytkownika");
		$stmt->execute(array(
			':nowe_haslo' => $nowe_haslo,
			':id_uzytkownika' =>$user_id
			));
		return '<div class="box-default box-success">Haslo poprawnie zmienione</div>';



		// 	return $stmt->fetch();



	}

}