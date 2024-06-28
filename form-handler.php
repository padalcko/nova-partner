<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Проверка данных
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Ошибка отправки формы. Пожалуйста, заполните все поля корректно.";
        exit;
    }

    // Укажите ваш email адрес
    $recipient = "padalcko.alexandr@gmail.com";
    $subject = "Новое сообщение от $name";

    // Составляем тело письма
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Сообщение:\n$message\n";

    // Заголовки письма
    $email_headers = "From: $name <$email>";

    // Отправка письма
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo "Спасибо за обращение, наш менеджер свяжется с вами в ближайшее время.";
    } else {
        echo "Ошибка отправки формы. Попробуйте еще раз.";
    }
} else {
    echo "Некорректный метод отправки формы.";
}
?>