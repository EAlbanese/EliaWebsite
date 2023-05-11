<?php
// Empfänger-Email-Adresse
$empfaenger = "info@elia-albanese.ch";

// Nachrichteninhalt
$name = $_POST['name'];
$email = $_POST['email'];
$nachricht = $_POST['nachricht'];
$betreff = "Neue Kontaktanfrage von " . $name;
$text = "Sie haben eine neue Kontaktanfrage von $name ($email):\n\n$nachricht";

// E-Mail senden
mail($empfaenger, $betreff, $text);

// Bestätigungsseite anzeigen
// echo "Vielen Dank für Ihre Anfrage! Wir werden uns bald bei Ihnen melden.";
?>
