<?php


namespace App\Controller;

use App\Entity\Contacts;
use App\Model\ContactsModel;
use Config\Config;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ContactSendMail extends Config
{
    private ContactsModel $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactsModel();
    }

    /**
     * @return ContactsModel
     */
    public function getContactModel(): ContactsModel
    {
        return $this -> contactModel;
    }



    /**
     * @return bool
     */
    public function contact()
    {

        return $this->render("layout.php", "front/contact.php", array(
            "titre" => "Contact"
        ));
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function sendMail()
    {
        try {
            $this->validate($_POST);
        } catch (Exception $e) {
            return $this->render("layout.php", "front/contact.php", array(
                'titre' => 'Erreur d\'Envoi',
                'success' => false,
                'error' => $e->getMessage(),
                'name' => null
            ));
        }

        $data = $this->sanitize($_POST);
        $contact = new Contacts();
        $contact->hydrate($data);
        $this->getContactModel()->insertMailSendByUser($contact);


        $myMail = 'alprod81@gmail.com';
        $mySecret = Config::CSRF_TOKEN_GMAIL;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = $myMail;
        $mail->Password = $mySecret;
        $mail->setFrom($contact->getEmail(), $contact->getNameContact());
        $mail->addAddress($myMail);
        $mail->Subject = $contact->getSujet();

        $name = $contact->getNameContact();
        $content = $contact->getMessage();
        $mail->isHTML(true);
        $mail->Body = $this->renderMessage($name, $content);

        if (!$mail->send()) {
            return $this->render("layout.php", "front/contact.php", array(
                'titre' => 'Erreur Mail',
                'success' => false,
                'error' => $mail->ErrorInfo,
                'name' => null
            ));
        }
        return $this->render("layout.php", "front/contact.php", array(
            'titre' => 'Envoi Mail',
            'success' => 'Message envoyé',
            'error' => [],
            'name' => $data['nameContact']
        ));
    }


    /**
     * @param $data
     * @throws Exception
     */
    public function validate($data)
    {

        $name = $data['nameContact'];
        $content = $data["message"];
        $mailEmail = $data["email"];
        $mailSujet = $data["sujet"];
        $rgexe10 = "/^[\w\W0-9]{10,}$/i";


        if (empty($name)) {
            throw new Exception('Veuillez indique un nom ou un Pseudo');
        }

        if (!filter_var($mailEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Le champ de votre email est incorrect');
        }

        if (strlen($mailSujet) <= 3) {
            throw new Exception('Votre titre du sujet est trop court');
        }

        if (empty($content) ||  strlen($content) < 10) {
            throw new Exception('Le message ne peut être vide, indiquez au minimum 10 caractères');
        }
    }

    /**
     * @param $name
     * @param $content
     * @return string
     */
    public function renderMessage($name, $content)
    {
        $message = '<html lang="fr">
                   <body>
                     <h2>Message de '.$name.'</h2>
                     <table>
                        <tr>
                          <th>Message</th>
                        </tr>
                        <tr>
                            <td>
                              '.$content.'
                            </td>
                        </tr>
                     </table>
                   </body>
               </html>';

        return $message;
    }
}
