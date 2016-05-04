<?php



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

		$this->view->grupa = $this->model->pobierzGrupePoID($id_grupy);

		$this->view->tytul = 'Panel administratora - Przydzielanie do grupy';
		$this->view->display('admin/przydziel_uzytkownikow');


	}

	
}