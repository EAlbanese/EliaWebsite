<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Informationen aus dem Kontaktformular erhalten
  $anrede = $_POST["anrede"];
  $vorname = $_POST["vorname"];
  $nachname = $_POST["nachname"];
  $email = $_POST["email"];
  $betreff = $_POST["betreff"];
  $nachricht = $_POST["nachricht"];

  // Discord Webhook-URL des Zielchannels
  $webhookurl = "https://discord.com/api/webhooks/1108022178357706812/JG8P-_bWGWpvB6tId1wVhrV_5axBVsou21SncKJxvHyKw88qUGaFEaf25oQllVDbiCK4";

  // JSON-Payload vorbereiten
  $payload = json_encode(array(
    "content" => "Neue Anfrage @everyone:\n\nAnrede: $anrede\nName: $vorname $nachname\n\nE-Mail: $email\n\nBetreff: $betreff\nNachricht: $nachricht"
  ));

  // cURL verwenden, um den Webhook zu senden
  $ch = curl_init($webhookurl);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
  ]);
  $result = curl_exec($ch);

  // Erfolgsmeldung ausgeben oder Fehlermeldung, falls etwas schiefgegangen ist
  if ($result === false) {
    echo "Leider ist ein Fehler aufgetreten, bitte kontaktieren Sie mich unter folgender E-Mail: info@elia-albanese.ch";
  } else {
    echo "Erfolgreich abgesendet!";
  }

  curl_close($ch);

  // E-Mail an den Absender senden
  $empfaenger = $_POST["email"];
  $betreff_mail = "=?UTF-8?B?" . base64_encode("Bestätigung: Ihre Anfrage wurde empfangen") . "?=";
  $nachricht_mail = "Vielen Dank für Ihre Anfrage, $anrede $nachname!\n\nIhre Anfrage wurde erfolgreich empfangen. Ich werde mich in Kürze mit Ihnen in Verbindung setzen.\n\nMit freundlichen Grüssen,\nElia Albanese";

  $header = "MIME-Version: 1.0" . "\r\n";
  $header .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
  $header .= "From: <info@elia-albanese.ch>" . "\r\n";

  mail($empfaenger, $betreff_mail, $nachricht_mail, $header);
}
?>
