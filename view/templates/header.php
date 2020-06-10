<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MANEGE</title>	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a href="<?= URL ?>home" class="navbar-brand">Manege</a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item mx-1"><a href="<?= URL ?>home" class="nav-link btn btn-outline-primary">Home</a></li>
			<li class="nav-item mx-1"><a href="<?= URL ?>horses" class="nav-link btn btn-outline-primary">Horses</a></li>
			<li class="nav-item mx-1"><a href="<?= URL ?>riders" class="nav-link btn btn-outline-primary">Planning</a></li>
			<?php if(isset($_SESSION['loggedInRName'])) {
				if($_SESSION['adminCode'] > 0) { ?>
					<li class="nav-item mx-1"><a href="<?= URL ?>adminPanel" class="nav-link btn btn-outline-danger">Admin panel</a></li>
				<?php } ?>
				<li class="nav-item mx-1"><a href="<?= URL ?>userportal/logout" class="nav-link btn btn-outline-primary">Log out: <?= $_SESSION['loggedInRName'] ?></a></li>
			<?php } ?>
		</ul>
	</nav>
