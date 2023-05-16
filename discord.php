<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Informationen aus dem Kontaktformular erhalten
  $vorname = $_POST["vorname"];
  $nachname = $_POST["nachname"];
  $email = $_POST["email"];
  $betreff = $_POST["betreff"];
  $nachricht = $_POST["nachricht"];

  // Discord Webhook-URL des Zielchannels
  $webhookurl = "https://discord.com/api/webhooks/1108022178357706812/JG8P-_bWGWpvB6tId1wVhrV_5axBVsou21SncKJxvHyKw88qUGaFEaf25oQllVDbiCK4";

  // JSON-Payload vorbereiten
  $payload = json_encode(array(
    "content" => "Neue Anfrage @everyone:\n\nName: $vorname $nachname\nE-Mail: $email\n\n Betreff: $betreff\nNachricht: $nachricht"
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
  curl_close($ch);

  // Erfolgsmeldung ausgeben oder Fehlermeldung, falls etwas schiefgegangen ist
  if ($result === false) {
    echo "Leider ist ein Fehler aufgetreten, bitte kontaktieren Sie mich unter folgender E-Mail: info@elia-albanese.ch";
  } else {
    echo "Erfolgreich abgesendet!";
  }
}
?>