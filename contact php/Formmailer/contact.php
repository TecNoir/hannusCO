<?php
// ===== Konfiguration:
$mailTo			= 'oliver@hannus.co';
$mailFrom		= '"Kontaktformular" <postmaster@hannus.co>';
$mailSubject	= 'Nachricht an Hannus.co';
$returnPage		= 'http://www.hannus.co/Erfolgsfall.html';
$returnErrorPage = 'http://www.hannus.co/Fehlerfall.html';
$mailText	   	 = " ";

// ============Text der Mail aus den Formularfeldern erstellen:
// Wenn Daten mit method="post" versendet wurden:
if(isset($_POST)) {
	//alle Formulardaten der Reihen nach durchgehen:
	foreach($_POST as $name => $value) {
	//Wenn der Feldwert aus mehreren Werten besteht:
	//z. B. (<select multiple>)
	if(is_array($value)) {
	//"Feldname:" und Zeilenumbruch dem Mailtext hinzufügen
	$mailText .= $name . ":\n";
	//alle Werte des Feldes abarbeiten
	foreach($valueArray as $entry){
	//Einrückungsleerzeichen, Wert und Zeilenumbruch
	//dem Mailtext hinzufügen
	$mailText .= "  " . $value . "\n";
	} //ENDE: foreach
	} //ENDE: if
	// Wenn der Feldwert ein einzelner Feldwert ist:
	else {
	//"Feldname:", Wert und Zeilenumbruch dem Mailtext
	//hinzufügen
	$mailText .= $name . ": " . $value . "\n";
	} //ENDE: else
	} //ENDE: foreach
	} // if

	// =========== Korrekturen vor dem Mailversand
	//Wenn PHP "Magic Quotes" vor Apostrophzeichen einfügt:
	if(get_magic_quotes_gpc()) {
		//eventuell eingefügte Backslashes entfernen
		$mailText = stripslashes($mailText);
	}

	// ========== Mailversand
	//Mail versenden und Versanderfolg merken
	$mailSent = mail($mailTo, $mailSubject, $mailText, "From: ".$mailFrom);

	// ========= Return-Seite an den Browser senden
	// Wenn der Mailversand erfolgreich war:
	if($mailSent == TRUE) {
	// Seite "Formular verarbeitet" senden:
	header("Location: " . $returnPage);
	}
	//Wenn die Mail nicht versendet werden konnte:
	else {
		// Seite "Fehler aufgetreten" senden:
	header("Location: " . $returnErrorPage);
	}

	// ======= Ende
	exit();
	?>
