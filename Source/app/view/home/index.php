<div id="home_wrap">

	<div id="logo">
		<a href="http://doublem.nazwa.pl/testy_online/"><img src="<?=__URL__?>images/new_logo.png"/></a>
	</div>

	<div id="flask">
		<img src="<?=__URL__?>images/SloikPomyslow.png"/>
	</div>

	<div id="register_href">
		<div class="btn-orange btn-color-default fb-smedium">Nie masz jeszcze swojego konta w serwisie Testy Online?</div>
		<br/>
		<a href="<?=__URL__?>rejestracja"><div class="fb-smedium btn-color-default btn-blue width-f240 text-center">Zarejestruj się</div></a>
	</div>


	<div id="login_form_box">

		<img id="login_form_box_title" src="<?=__URL__?>images/logowanie_title.png"/>

		<div class="mtop-75"></div>
		<form action="<?=__URL__?>home/zaloguj" method="POST" id="ajax_login">

			<div class="preform-icon"><i class="fa fa-user" aria-hidden="true"></i></div> <input placeholder="Adres E-mail" type="text" name="email" class="form-full-width width-50" placeholder=""/><br/>
			<div class="preform-icon"><i class="fa fa-lock" aria-hidden="true"></i></div> <input placeholder="Hasło" type="password" name="haslo" class="form-full-width width-50" placeholder=""/><br/>

			<input type="submit" class="width-100" id="btn_zaloguj" value="Zaloguj"/>

		</form>

		<div id="form_callback"></div>

	</div>

</div>

