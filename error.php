<?php


class EmailSendingException extends RuntimeException
{
    public $message = "Impossible d'envoyer l'email.";
}

class NotificaitionSendingException extends RuntimeException
{
    public $message = "Impossible d'envoyer la Notification.";
}

class ShortText extends RuntimeException
{
    public $message = "Le texte fournis est trop court.";
}



function sendMail(string $text): bool
{
    if (false) {
        throw new EmailSendingException();
    }

    return true;
}

function sendNotification(string $text): bool
{
    if (false) {
        throw new NotificaitionSendingException();
    }

    return true;
}

function sendMessage(string $text): bool
{
    if (strlen($text) < 10) {
        throw new ShortText();
    }

    try {
        sendNotification($text);
    } catch (NotificaitionSendingException $e) {
        
    } finally {
        sendMail($text);
        return true;
    }


    return true;
}

try {
    sendMessage('Hello');
} catch (ShortText $e) {
    echo $e->getMessage();
} catch (EmailSendingException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo 'Une erreur inattendue est survenue, nos équipes ont été prévenues, veuillez réessayer plus tard';
}
