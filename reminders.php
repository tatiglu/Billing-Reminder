<?php
    $chatId = "--your tg chat ID--";

    $currentDate = new DateTime();

    if ($currentDate->format('G') == 11) {

        $dayOfWeek = $currentDate->format('N');

        // Если сегодня выходной (6 - суббота, 7 - воскресенье), переносим на понедельник
        if ($dayOfWeek == 6) {
            $currentDate->add(new DateInterval('P2D'));
        } elseif ($dayOfWeek == 7) {
            $currentDate->add(new DateInterval('P1D'));
        }

        $lastDayOfMonth = $currentDate->format('t');

        $dayOfMonth = $currentDate->format('j');

        if ($dayOfWeek >=1 && $dayOfWeek<=5) {
            switch ($dayOfMonth) {
                case 4:
                    sendMessage($chatId, "Выставить счет 1");
                    break;
                case 6:
                    sendMessage($chatId, "Выставить счет 2");
                    break;
                case 7:
                    sendMessage($chatId, "Выставить счет 3");
                    break;
                case 8:
                    sendMessage($chatId, "Выставить счет 4");
                    break;
                case 27:
                    sendMessage($chatId, "Выставить счет 5");
                    break;
                case $lastDayOfMonth:
                    sendMessage($chatId, "Выставить счет 6");
                    break;
                default:
                    break;
            }
        }

    } else {
        echo "Сейчас не время выставлять счета.\n";
    }


function sendMessage($chatId, $message) {
    $token = "--your tg token--";
    $url = "https://api.telegram.org/bot$token/sendMessage";

    $postData = http_build_query([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $postData,
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if (!$result) {
        // Обработка ошибок отправки сообщения
        echo "Ошибка отправки сообщения";
    } else {
        echo "Сообщение успешно отправлено";
    }
}
