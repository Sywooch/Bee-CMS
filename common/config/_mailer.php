<?php
/*
 * Настройки отправки сообщений
 * @param useFileTransport - по умолчанию отправляет емейл в виде файла,
 * который находится в /frontend/runtime/mail/
 * Для отправки почты, нужно установить значение в "FALSE"
 */
return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@common/mail',
    // send all mails to a file by base. You have to set
    // 'useFileTransport' to false and configure a transport
    // for the mailer to send real emails.
    'useFileTransport' => false,
];