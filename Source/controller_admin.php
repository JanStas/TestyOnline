<?php

/**
*
* controller_home.php
* extends Controller.php
*
* @author Marcin Domowicz 		<kontakt@doublem.pl>
* @author Miłosz Zaczyński 		<kontakt@doublem.pl>
*
*/

class Admin extends Controller {

	public function index() {

		if ($this->czyAdminZalogowany()) {
			$this->redirect('admin/panel');
		}


		$this->view->js = array(

			'js/pages/universal.js'

		);

		$this->view->tytul = 'Panel administratora - Panel';
		$this->view->display('admin/index');

			

		
		
	}

	public function logowanie() {

		echo $this->model->walidacjaZalogujAdministratora($_POST);

	}

	public function panel() {

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}


		$this->view->tytul = 'Panel administratora - Panel';
		$this->view->display('admin/panel');



	}

	public function wyloguj() {

		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_nazwa']);

		$this->redirect('admin/index');
	}

	public function grupy() {

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}

		$this->view->grupy = $this->model->pobierzGrupy();

		$this->view->tytul = 'Panel administratora - Grupy';
		$this->view->display('admin/grupy');

	}

	public function dodaj_nowa_grupe() {

		$this->view->js = array(

			'js/pages/universal.js'

		);

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}

		$this->view->tytul = 'Panel administratora - Tworzenie nowej grupy';
		$this->view->display('admin/dodaj_nowa_grupe');

	}

	public function dodaj_nowa_grupe_walidacja() {
		echo $this->model->walidacjaDodajNowaGrupe($_POST);
	}

	public function usun_grupe($id) {
		echo $this->model->walidacjaUsunGrupe($id);
	}

	public function przydziel_uzytkownikow($id_grupy) {

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}

		if (isset($_POST['zapisz_przydzielenie'])) {
			$this->view->callback_msg = $this->model->zapiszPrzydzielenie($_POST['czy_nalezy'], $id_grupy);
		}

		$this->view->grupa = $this->model->pobierzGrupePoID($id_grupy);
		$this->view->grupa->grupa_naleza = explode(',', $this->view->grupa->grupa_naleza);

		$grupa_naleza = explode(',', $this->view->grupa->grupa_naleza);

		//print_r($grupa_naleza);

		$this->view->uzytkownicy = $this->model->pobierzUzytkownikow();



		$this->view->tytul = 'Panel administratora - Przydzielanie do grupy';
		$this->view->display('admin/przydziel_uzytkownikow');


	}

	public function tworzenie_testu() {

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}

		if (isset($_POST['dodaj_nowy_test'])) {

			$error = false;

			for ($i = 1; $i<=10; $i++) {
				if (empty($_POST['odp_pyt_'. $i .'a']) || empty($_POST['odp_pyt_'. $i .'b']) || empty($_POST['odp_pyt_'. $i .'c'])) {
					$this->view->rollback_msg = 'Uzupełnij wszystkie odpowiedzi!';
					$error = true;
					echo 'tutaj cos' . $i .'<br/>';
				}	
			}

			if (empty($_POST['nazwa_testu'])) {
				$this->view->rollback_msg = 'Uzupełnij nazwe testu!';
				$error = true;
			}

			if (!$error) {
				$this->view->rollback_msg = $this->model->stworzNowyTest($_POST);
			}


		}

		$this->view->tytul = 'Panel administratora - Tworzenie nowego testu';
		$this->view->display('admin/tworzenie_testu');



	}

	public function przypisz_test($id_grupy) {

		if (!$this->czyAdminZalogowany()) {
			$this->redirect('admin/index');
		}

		if (isset($_POST['przypisz_test'])) {
			$this->model->walidacjaPrzypiszTest($_POST, $id_grupy);
		}

		$this->view->testy = $this->model->pobierzTesty();

		$this->view->tytul = 'Panel administratora - Przypisywanie testu do grupy';
		$this->view->display('admin/przypisz_test');

	}

	
}