<?php


function sendMail(string $text): bool
{
    if(false)
    {
        throw new Exception("L'envoi du mail à échoué", 'send_mail_fall');
    }

    return true;
}

function sendNotification(string $text): bool
{
    if(false)
    {
        throw new Exception("L'envoi de la notification à échoué", 'send_notification_fall');
    }

    return true;
}

function sendMessage(string $text): bool
{
    if(strlen($text) < 10)
    {
        throw new Exception("Le texte est trop court, min 10 caractères", 'send_length_message_fall');
    }

    return true;
}

sendMessage('Hello');

