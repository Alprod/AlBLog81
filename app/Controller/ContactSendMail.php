<?php


namespace App\Controller;

use Config\Config;

class ContactSendMail extends Config
{
    public function contact()
    {

        return $this->render("layout.php","front/contact.php",array(
            "titre" => "Contact"
        ));
    }


    /**
     *
     * @return mixed
     */
    public function sendMail()
    {
        $allPost = $_POST;
        $name = $_POST['inputName'];
        $content = $_POST["message"];
        $mailEmail = $_POST["inputEmail"];
        $mailSujet = $_POST["inputSujet"];
        $webMaster = $_SERVER['SERVER_ADMIN'];

        $message ='<html lang="fr">
                       <body>
                         <h2>Message de '.htmlspecialchars($name).'</h2>
                         <table>
                            <tr>
                              <th>Message</th>
                            </tr>
                            <tr>
                                <td>
                                  '.htmlspecialchars($content).'
                                </td>
                            </tr>
                         </table>
                       </body>
                   </html>';
        $headers[]= "MIME-Version: 1.0";
        $headers[]= "Content-type: text/html charset=iso-8859-1";
        $headers[]= "From : ".$name;
        $headers[]= "Mail : ".$mailEmail;

        $sending = true;
        $successMail= "Mail envoyer";
        $errorSend= "Mail Non envoyer car il mmanque des informations";

        $sendMail = mail($webMaster,$mailSujet,$message, implode("\r\n",$headers));

        if ( !$sendMail || empty($name) || empty($mailEmail) || empty($message)) {
            $errorSend;
            $sending = false;

        }
        else{
            $successMail;
        }

        return $this->render("layout.php","front/contact.php",array(
            'titre' => 'Envoi Mail',
            'success' => $successMail,
            'error' => $errorSend,
            'name' => $name
        ));

    }

}