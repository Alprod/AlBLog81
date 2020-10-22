<?php


namespace App\Controller;

use Config\Config;

class ContactSendMail extends Config
{
    public function contact()
    {

        return $this->render("layout.php","contact.php",array(
            "titre" => "Contact"
        ));
    }


    /**
     * @param string $to
     * @param $subject
     * @param $content
     * @return mixed
     * @noinspection PhpOptionalBeforeRequiredParametersInspection
     */
    public function sendMail(string $to = 'alprod81@gmail.com', $subject, $content)
    {
        $webMaster = $to;
        $name = $_POST['inputName'];
        $mailTitle = $subject;
        $message ='<html lang="fr">
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
        $headers[]= "MIME-Version: 1.0";
        $headers[]= "Content-type: text/html charset=iso-8859-1";

        $sendMail = $this->mail($webMaster,$mailTitle,$message, implode("\r\n",$headers));

        if ( !$sendMail ) {
            $errorSend = "";
        }
        else{
            $successMail = "";
        }

        return $sendMail;
    }

}