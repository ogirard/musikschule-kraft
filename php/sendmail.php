<?php

try {

    $message = json_decode(file_get_contents("php://input"));

    $firstname = htmlspecialchars(trim($message->firstname));
    $lastname = htmlspecialchars(trim($message->lastname));
    $email = htmlspecialchars(trim($message->email));
    $messagecontent = nl2br(htmlentities(trim($message->messagecontent)));
    $reason = $message->reason;
	
    // validate
    if (empty($firstname) || empty($lastname) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($messagecontent)) {
        errorResponse('Validierung fehlgeschlagen');
        die();
    }

    $contactReason = "Nicht bekannt";
    switch ($reason) {
        case "einzelunterricht":
            $contactReason = "Einzelunterricht";
            break;
        case "gruppenkurs":
            $contactReason = "Gruppenkurs";
            break;
        case "feedback":
            $contactReason = "Feedback zur Homepage";
            break;
        case "sonstige":
            $contactReason = "Sonstiges";
            break;
    }

    $contact = 'kontakt@musikschule-kraft.ch';
    $subject = "www.musikschule-kraft.ch: Nachricht von $message->firstname $message->lastname zum Thema $contactReason";
    $subject = str_ireplace(array("\r", "\n", '%0A', '%0D'), '', $subject);
    $date = date('d.m.Y H:i:s');
    $mailBody = "
<!doctype html>
<html>
<head>
  <title>www.musikschule-kraft.ch: Nachricht von $message->firstname $message->lastname</title>
  <style>
    body { font-family: Calibri, Verdana, Arial, sans-serif; color: #666666; font-size: 11pt; }
    h3 { color: #355f99; font-size: 12pt; }
    h4 { color: #999999; font-size: 11pt; }
  </style>
</head>
<body>
  <img src=\"http://localhost:63342/musikschule-kraft.ch/img/logo_front.png\" alt=\"Musikschule Kraft\" /><br />
  <h3>Nachricht von $firstname $lastname, $email</h3>
  <h4>$date</h4>
  <strong>Kontaktgrund: $contactReason</strong>
  <br />
  <p>$messagecontent</p>
</body>
</html>
";

    $header = 'MIME-Version: 1.0' . PHP_EOL;
    $header .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL;
    $header .= "To: Musikschule Kraft <$contact>" . PHP_EOL;
    $header .= "From: $firstname $lastname <$email>" . PHP_EOL;

    if (mail($contact, $subject, $mailBody, $header)) {
        successResponse();
    } else {
        errorResponse();
    }

} catch (Exception $e) {
    errorResponse($e->getMessage());
}


function errorResponse($message = '')
{
    // an error has occured, don't leak internal data
    header("HTTP/1.1 500 Internal Server Error");

    echo 'Mail konnte nicht versendet werden.' . PHP_EOL . $message;
}

function successResponse()
{
    // ok
    header("HTTP/1.1 200 OK");

    echo 'Mail wurde erfolgreich versendet.';
}