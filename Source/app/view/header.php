<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- Include Meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Language" content="pl"/>
		<meta name="author" content="doublem.pl"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>
			<?php if (isset($this->tytul)) { echo $this->tytul; } ?>
		</title>
		<link rel="Shortcut icon" href="" />
		<meta name="description" content=""/>
		<meta name="keyword" content=""/>
		<!-- /Include Meta -->

		<!-- Include CSS Files -->
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/bootstrap-custom.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/bootstrap-responsive.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/facebook.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/lightbox.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/skdslider.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/jquery.bxslider.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/plugins/font-awesome.css"/>

		<link rel="stylesheet" href="<?php echo __URL__; ?>css/responsive/formatting.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/responsive/primary.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/responsive/mobile.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/responsive/tablet.css"/>
		<link rel="stylesheet" href="<?php echo __URL__; ?>css/responsive/desktop.css"/>

		<?php 

		if (isset($this->css)) {
			foreach ($this->css as $style) {
				?>
					<link rel="stylesheet" href="<?php echo __URL__ . $style; ?>"/>
				<?php
			}	
		}	


		?>
		<!-- /Include CSS Files -->

		<!-- Include JS Files -->
		<script src="<?php echo __URL__; ?>js/jquery.js"></script>
		<script src="<?php echo __URL__; ?>js/cookies.js"></script>
		<script src="<?php echo __URL__; ?>js/facebook.js"></script>
		<script src="<?php echo __URL__; ?>js/lightbox.js"></script>
		<script src="<?php echo __URL__; ?>js/skdslider.js"></script>
		<script src="<?php echo __URL__; ?>js/jquery.bxslider.js"></script>
		<script src="<?php echo __URL__; ?>js/custom.js"></script>

		<?php 

		if (isset($this->js)) {
			foreach ($this->js as $js) {
				?>
					<script src="<?php echo __URL__; ?><?=$js;?>"></script>
					
				<?php
			}
		}

		?>
		<!-- /Include JS Files -->
	</head>
	<body>