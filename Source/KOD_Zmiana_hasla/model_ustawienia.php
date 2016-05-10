<?php

/**
*
* Model_home.php 
* extends Model.php
*
* @author Mateusz Sorys
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



		// 	return $stmt->fetch(

	}
	public function pobierz_dane_uzytkownika($id)
	{
		$stmt = $this->dbh->prepare("SELECT imie,nazwisko,email from uzytkownicy where id=:id_uzytkownika");
		$stmt->execute(array(
			':id_uzytkownika'=>$id
			));
		return $stmt->fetch();
	}

	public function walidacja_zmiana_danych($post,$id)
	{
		if(empty($post['imie'])|| empty($post['nazwisko'])||empty($post['email'])||empty($post['pow_email'])){
			return 'Uzupełnij wszystkie pola';
			exit();
		}
		if($post['email']==$post['pow_email'])
		{
			$stmt=$this->dbh->prepare("UPDATE uzytkownicy set imie=:imie, nazwisko=:nazwisko, email=:email where id=:id_uzytkownika");
			$stmt->execute(array(
				':imie'=>$post['imie'],
				':nazwisko' =>$post['nazwisko'],
				':email'=>$post['email'],
				':id_uzytkownika'=>$id
				));

			return 'Dane zmienione poprawnie!';
		}
		else
		{
			return 'Adres email i powtórzony adres email muszą byc takie same!';
			exit();
		}
	}
}