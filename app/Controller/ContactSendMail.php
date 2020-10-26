<?php


namespace App\Controller;

use Config\Config;
use Exception;

class ContactSendMail extends Config
{
    public function contact()
    {

        return $this->render("layout.php","front/contact.php",array(
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

        }catch (Exception $e){
            return $this->render("layout.php","front/contact.php",array(
                'titre' => 'Erreur d\'Envoi',
                'success' => false,
                'error' => $e->getMessage(),
                'name' => null
            ));

        }

        $data = $this->sanitize($_POST);

        $to = [
            'name'=>$data['inputName'],
            'email' => 'alprod81@gamil.com'
            ];
        $message = $this->renderMessage($data['inputName'], $data['message']);

        $this->email($to['email'],$data['message'],$message);

        return $this->render("layout.php","front/contact.php",array(
            'titre' => 'Envoi Mail',
            'success' => 'Mail envoyer',
            'error' => [],
            'name' => $data['inputName']
        ));
    }


    /**
     * @param $data
     * @throws Exception
     */
    public function validate($data)
    {

        $name = $data['inputName'];
        $content = $data["message"];
        $mailEmail = $data["inputEmail"];
        $mailSujet = $data["inputSujet"];
        $rgexe10 = "/^[\w\W0-9]{10,}$/i";


        if(empty($name)){
            throw new Exception('Veuillez indique un nom ou un Pseudo');
        }

        if(!filter_var($mailEmail, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Le champ de votre email est incorrect');
        }

        if(strlen($mailSujet) <= 3){
            throw new Exception('Votre titre du sujet est trop court');
        }

        if(empty($content) ||  strlen($content) < 10){
            throw new Exception('Le message ne peut être vide, indiquez au minimum 10 caractères');
        }

    }

    /**
     * @param $to
     * @param $subject
     * @param $message
     * @return bool
     * @throws Exception
     * @noinspection PhpUnreachableStatementInspection
     */
    public function email($to, $subject, $message)
    {

        $sendMail = mail($to,$subject,$message);
        if(!$sendMail){
            throw new Exception('Une erreur est survenu lors de l\'envoi');
            return false;
        }
        return true;
    }

    public function renderMessage($name,$content)
    {
        return '<html lang="fr">
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
    }



}