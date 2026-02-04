<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@devwebcamp.com', 'DevWebCamp'); // Puedes cambiar el nombre aquí si lo deseas
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<style>';
        $contenido .= 'body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }';
        $contenido .= '</style>';
        $contenido .= '<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">';
        $contenido .= '<div style="width: 100%; background-color: #f4f4f4; padding: 40px 0;">';
        $contenido .= '<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">';
        
        // Título actualizado
        $contenido .= '<h1 style="color: #DB2777; text-align: center; font-size: 32px; margin-bottom: 30px;">DevWebCamp</h1>';
        
        $contenido .= '<p style="color: #4B5563; font-size: 18px; line-height: 1.6; margin-bottom: 20px;"><strong>Hola ' . $this->nombre . '</strong>,</p>';
        $contenido .= '<p style="color: #4B5563; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">Has creado tu cuenta en DevWebCamp correctamente. Solo debes confirmarla presionando el siguiente botón:</p>';

        // Botón con variable de entorno HOST
        $contenido .= '<div style="text-align: center; margin-bottom: 30px;">';
        $contenido .= '<a href="' . $_ENV['HOST'] . '/confirmar-cuenta?token=' . $this->token . '" style="background-color: #DB2777; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">Confirmar Cuenta</a>';
        $contenido .= '</div>';

        $contenido .= '<p style="color: #4B5563; font-size: 14px; line-height: 1.6; margin-bottom: 10px;">Si tú no solicitaste esta cuenta, puedes ignorar este mensaje.</p>';
        $contenido .= '<div style="border-top: 1px solid #e5e7eb; margin-top: 30px; padding-top: 20px; text-align: center;">';
        $contenido .= '<p style="color: #9CA3AF; font-size: 12px;">Este correo fue enviado automáticamente por DevWebCamp.</p>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        // AQUI ESTABA EL ERROR: Ahora usa las variables del .env en lugar de valores fijos
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@devwebcamp.com', 'DevWebCamp');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu Password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<style>';
        $contenido .= 'body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }';
        $contenido .= '</style>';
        $contenido .= '<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">';
        $contenido .= '<div style="width: 100%; background-color: #f4f4f4; padding: 40px 0;">';
        $contenido .= '<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">';
        
        // Título actualizado
        $contenido .= '<h1 style="color: #DB2777; text-align: center; font-size: 32px; margin-bottom: 30px;">DevWebCamp</h1>';
        
        $contenido .= '<p style="color: #4B5563; font-size: 18px; line-height: 1.6; margin-bottom: 20px;"><strong>Hola ' . $this->nombre . '</strong>,</p>';
        $contenido .= '<p style="color: #4B5563; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">Parece que has olvidado tu password, sigue el siguiente enlace para recuperarlo</p>';

        // Botón con variable de entorno HOST
        $contenido .= '<div style="text-align: center; margin-bottom: 30px;">';
        $contenido .= '<a href="' . $_ENV['HOST'] . '/reestablecer?token=' . $this->token . '" style="background-color: #DB2777; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">Reestablecer Password</a>';
        $contenido .= '</div>';

        $contenido .= '<p style="color: #4B5563; font-size: 14px; line-height: 1.6; margin-bottom: 10px;">Si tú no solicitaste esta cuenta, puedes ignorar este mensaje.</p>';
        $contenido .= '<div style="border-top: 1px solid #e5e7eb; margin-top: 30px; padding-top: 20px; text-align: center;">';
        $contenido .= '<p style="color: #9CA3AF; font-size: 12px;">Este correo fue enviado automáticamente por DevWebCamp.</p>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}
