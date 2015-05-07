<?php
/*
 * @param enableCsrfValidation - CSRF защита от межсайтовых подделок запроса - https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B6%D1%81%D0%B0%D0%B9%D1%82%D0%BE%D0%B2%D0%B0%D1%8F_%D0%BF%D0%BE%D0%B4%D0%B4%D0%B5%D0%BB%D0%BA%D0%B0_%D0%B7%D0%B0%D0%BF%D1%80%D0%BE%D1%81%D0%B0
 * @param cookieValidationKey - Секретный ключ для валидации Куки при отправке запросов
 * @param baseUrl - Удалить префикс "web/" в URL (При использовании Apache в качестве веб-сервера)
 */
return [
    'baseUrl' => '',
    'enableCsrfValidation' => true,
    'cookieValidationKey' => '8JB0z0pMnWauQAkw3bDKW9zyQtPP4FuK',
];