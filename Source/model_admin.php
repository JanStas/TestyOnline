<?php

/**
*
* Model_home.php 
* extends Model.php
*
* @author Marcin Domowicz 		<kontakt@doublem.pl>
* @author Miłosz Zaczyński 		<kontakt@doublem.pl>
*
*/

class model_admin extends Model {

	public function walidacjaZalogujAdministratora($post) {

		if (empty($post['username']) || empty($post['password'])) {
			return 'Zły login lub hasło.';
		} else {

			$login = $post['username'];
			$passw = md5($post['password']);

			$stmt = $this->dbh->prepare("SELECT id_admin, log_admin FROM admin WHERE log_admin = :log_admin AND pass_admin = :pass_admin");
			$stmt->execute(array(
				':log_admin'		=> $login,
				':pass_admin'		=> $passw
			));

			$result = $stmt->fetch();

			if ($stmt->rowCount() != 0) {

				$_SESSION['admin_id'] 		= $result->id_admin;
				$_SESSION['admin_nazwa']	= $result->log_admin;

				return 'ok';

			} else {
				return 'Zły login lub hasło.';
			}




		}


	}

	public function walidacjaDodajNowaGrupe($post) {
		if (empty($post['nazwa_grupy'])) {
			return 'Musisz podać nazwę grupy';
		} else {

			$stmt = $this->dbh->prepare("INSERT INTO grupy VALUES('', :nazwa_grupy, '', NULL)");
			$stmt->execute(array(
				':nazwa_grupy'	=> $post['nazwa_grupy']
			));

			return 'ok';

		}
	}

	public function pobierzGrupy() {
		$stmt = $this->dbh->prepare("

			SELECT grupy.*, testy.nazwa as nazwa_testu FROM grupy
			LEFT JOIN testy ON grupy.przypisany_test = testy.id

			ORDER BY grupy.grupa_nazwa ASC

		");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function pobierzTesty() {
		$stmt = $this->dbh->prepare("SELECT * FROM testy ORDER BY nazwa ASC");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function walidacjaUsunGrupe($id) {
		$stmt = $this->dbh->prepare("DELETE FROM grupy where grupa_id = :grupa_id");
		$stmt->execute(array(
			':grupa_id'	=> $id
		));

		return 'ok';
	}

	public function walidacjaPrzypiszTest($post, $id_grupy) {
		$stmt = $this->dbh->prepare("UPDATE grupy SET przypisany_test = :przypisany_test WHERE grupa_id = :grupa_id");
		$stmt->execute(array(
			':przypisany_test'	=> $post['przypisanie_testu'],
			':grupa_id'			=> $id_grupy
		));
		echo 'Test został przypisany do tej grupy';
	}



	public function zapiszPrzydzielenie($arr, $id_grupy) {

		if (empty($arr)) {
			$stmt = $this->dbh->prepare("UPDATE grupy set grupa_naleza = '' WHERE grupa_id = :grupa_id");
			$stmt->execute(array(
				':grupa_id'		=> $id_grupy
			));
			return 'ok';
		} else {
			$sklej_idki = '';

			foreach($arr as $key => $value) {
				$sklej_idki .= $key . ',';
			}

			$sklej_idki = substr_replace($sklej_idki, "", -1);

			$stmt = $this->dbh->prepare("UPDATE grupy set grupa_naleza = :naleza where grupa_id = :grupa_id");
			$stmt->execute(array(
				':naleza'	=> $sklej_idki,
				':grupa_id'	=> $id_grupy
			));

			return 'ok';

		}


	}

	public function stworzNowyTest($post) {
		//najpierw dodaj nowy test
		$stmt = $this->dbh->prepare("INSERT INTO testy VALUES('', :nazwa_testu)");
		$stmt->execute(array(
			':nazwa_testu'	=> $post['nazwa_testu']
		));

		//teraz wez identyfikator ostatniego dodanego id
		$id_testu = $this->dbh->lastInsertId();

		//mamy id, teraz mozemy zaczac na ten ID dodawac pytanka
		for ($i=1; $i<=10; $i++) {

			$prawidlowa_odpowiedz = $post['checkbox_' . $i];

			$odpowiedz_a = $post['odp_pyt_'.$i.'a'];
			$odpowiedz_b = $post['odp_pyt_'.$i.'b'];
			$odpowiedz_c = $post['odp_pyt_'.$i.'c'];

			$numer_pytania = $i;

			$stmt = $this->dbh->prepare("INSERT INTO testy_odpowiedzi VALUES('', :id_testu, :numer_pytania, :odpowiedz_a, :odpowiedz_b, :odpowiedz_c, :prawidlowa_odpowiedz)");
			$stmt->execute(array(
				':id_testu'			=> $id_testu,
				':numer_pytania'	=> $numer_pytania,
				':odpowiedz_a'		=> $odpowiedz_a,
				':odpowiedz_b'		=> $odpowiedz_b,
				':odpowiedz_c'		=> $odpowiedz_c,
				':prawidlowa_odpowiedz'	=> $prawidlowa_odpowiedz
			));

		}

		return 'Test stworzony!';
	}

}