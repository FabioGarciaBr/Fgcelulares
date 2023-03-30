<?php
// Inclui a biblioteca PHPMailer
require_once('PHPMailer/PHPMailerAutoload.php');

if(isset($_POST['email'])) {

    // Configuração do remetente
    $email_to = "devfabiogarcia@gmail.com";
    $email_subject = "Nova mensagem do formulário de contato";

    function died($error) {
        // Mensagem de erro
        echo "Ocorreram erros no envio do formulário. ";
        echo "Os erros são os seguintes:<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor, corrija-os e tente enviar o formulário novamente.<br /><br />";
        die();
    }

    // Validação dos dados do formulário
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Ocorreu um erro ao enviar o formulário.');       
    }

    $name = $_POST['name']; // Nome
    $email = $_POST['email']; // Email
    $message = $_POST['message']; // Mensagem

    $error_message = "";

    // Validando os campos
    if(strlen($error_message) > 0) {
        died($error_message);
    }

    // Configuração do servidor SMTP
    $config = array(
        'ssl' => 'ssl',
        'port' => 465,
        'auth' => true,
        'username' => 'devfabiogarcia@gmail.com',
        'password' => 'fpp180783'
    );

    // Criação do objeto PHPMailer
    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = $config['port'];
    $mail->SMTPSecure = $config['ssl'];
    $mail->SMTPAuth = $config['auth'];
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];
    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($email_to);
    $mail->Subject = $email_subject;

    // Corpo da mensagem
    $email_body = "Nova mensagem recebida do formulário de contato.\n\n";
    $email_body .= "Nome: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Mensagem:\n$message\n";

    $mail->Body = $email_body;

    if(!$
