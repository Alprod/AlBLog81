<?php


namespace App\Controller;

use App\Entity\Contacts;
use App\Model\ContactsModel;
use Config\Config;
use Config\Params\Parameter;
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

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = Parameter::EMAIL_WEB_MASTER;
        $mail->Password = Parameter::TOKEN_GMAIL;
        $mail->setFrom($contact->getEmail(), $contact->getNameContact());
        $mail->addAddress(Parameter::EMAIL_WEB_MASTER);
        $mail->Subject = $contact->getSujet();

        $name = $contact->getNameContact();
        $content = $contact->getMessage();
        $sujet = $contact->getSujet();
        $mail->isHTML(true);
        $mail->Body = $this->renderMessage($name, $sujet, $content);

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
     * @param $sujet
     * @param $content
     * @return string
     */
    public function renderMessage($name, $sujet, $content)
    {
        $message = '<html lang="fr">
                   <body>
                     <h2>Message de '.$name.'</h2>
                     <div>
                        <p><b> Titre du sujet: </b>'.$sujet.'</p>
                        <p>'.$content.'</p>
                     </div>
                   </body>
               </html>';

        return $message;
    }
}
