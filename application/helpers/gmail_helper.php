<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once "Mail.php";
require_once "Mail/mime.php";

class Gmail
{
    public static function SendMail($data, $name, $subject) {
        // yum install php-pear-Mail
        // yum install php-pear-Mail-Mime.noarch
        // or: pear install Mail_Mime
        $from = "Automedsys Support <support@automedsys.com>";
        $to = trim($name)." <".$data['email'].">";

        $headers = [
                'From' => $from,
                'To' => $to,
                'Reply-To' => $from,
                'Subject' => $subject,
                'Bcc' => $from
            ];

            $html = $data['html'];

            $crlf = "\r\n";
            // Creating the Mime message
            $mime = new Mail_mime($crlf);

            // Setting the body of the email
            $mime->setTXTBody(strip_tags($html));
            $mime->setHTMLBody($html);

            $body = $mime->get();
            $headers = $mime->headers($headers);

        $host = "ssl://smtp.gmail.com";
        $username = "demo@automedsys.com"; // "support@automedsys.com";
        $password = "<Wy7>R3D"; // "may12002@2021!";

        $smtp = Mail::factory('smtp',
        array (
            'host' => $host,
            'port' => 465,
            'auth' => true,
            'username' => $username,
                'password' => $password)
            );

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            return [true, $mail->getMessage(), $body];
        }
        return [false, "Message successfully sent!", $html];
    }

    public static function ExtractTitle($html, $def) {
        $res = preg_match("/<title>(.*)<\/title>/siU", $html, $title_matches);
        if (!$res) {
            return $def; 
        }
        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }
}


