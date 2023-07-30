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
    "content" => "Neue Anfrage @everyone:\n\nName: $vorname $nachname\n\nE-Mail: $email\n\nBetreff: $betreff\nNachricht: $nachricht"
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

  // Fehlerbehandlung für cURL-Anfrage
  if ($result === false) {
    echo "Leider ist ein Fehler beim Senden der Discord-Nachricht aufgetreten.";
    // Hier können Sie weitere Aktionen hinzufügen, wenn die Discord-Nachricht nicht gesendet wurde
  } else {
    echo "Erfolgreich abgesendet!";
    // Hier können Sie weitere Aktionen hinzufügen, wenn die Discord-Nachricht erfolgreich gesendet wurde
  }

  curl_close($ch);

  // E-Mail an den Absender senden
  $empfaenger = $_POST["email"];
  $betreff_mail = "Ihre Anfrage wurde empfangen";
  $nachricht_mail = "Vielen Dank für Ihre Anfrage, $nachname!\n\nIhre Anfrage wurde erfolgreich empfangen. Ich werde mich in Kürze mit Ihnen in Verbindung setzen.\n\nMit freundlichen Grüssen,\nElia Albanese";

  // E-Mail-Versand
  $mail_success = mail($empfaenger, $betreff_mail, $nachricht_mail);

  // Fehlerbehandlung für E-Mail-Versand
  if ($mail_success) {
    echo "Erfolgreich abgesendet!";
    // Erfolgsnachricht für den E-Mail-Versand
    // Hier können Sie weitere Aktionen hinzufügen, wenn die E-Mail erfolgreich gesendet wurde
  } else {
    echo "Leider ist ein Fehler beim Senden der Email aufgetreten.";
    // Fehlermeldung für den E-Mail-Versand
    // Hier können Sie weitere Aktionen hinzufügen, wenn die E-Mail nicht gesendet wurde
  }
}
?>
