<?php

function error_404_con() {
	echo "404 - De gevraagde route is niet beschikbaar. Controleer je controller";
	header("location: home");
}
function error_404_act() {
	echo "404 - De gevraagde route is niet beschikbaar. Controleer je action naam";
	// header("location: home");
}