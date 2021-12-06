<?php

namespace App\Authentification;
use App\Authentification\Exception\AuthentificationException;
use App\MyPDO\template\MyPDO;
use Exception;
use PDO;
use Symfony\Component\HttpFoundation\RequestStack;

const CODE_INPUT_NAME = 'code';
const SESSION_CHALLENGE_KEY = 'challenge';

class SecureUserAuthentification extends AbstractUserAuthentification
{
    /**
     * @throws Exception
     */
    public function loginForm(string $action, string $submitText='OK') : string{
        $session = $this->request->getSession();
        $key = $random = random_bytes(10);
        $session->set(SESSION_CHALLENGE_KEY, $key);
        $code = CODE_INPUT_NAME;
        $html =<<<HTML
            <form method="GET" action="$action" class="bg-dark">
                <input type="text" id="login" class="form-control" placeholder="login" required>
                <input type="password" id="pass" class="form-control" placeholder="pass" required>
                <input type="hidden" id="challenge" value=$key>
                <input hidden type='hidden' name=$code id="code">
                <button type="submit" class="btn btn-primary" name="ok-submit">$submitText</button>
            </form>
            <script type="text/javascript" src="js/sha512.js">
                window.onsubmit()= function(){
                    let log = document.querrySelector('#login');
                    let pass = document.querrySelector('#pass');
                    let challenge = document.querrySelector('#challenge');
                    let hash = CryptoJs.SHA512(CryptoJs.SHA512(pass)+challenge+CryptoJs.SHA512(log));
                    let code = document.querrySelector('#code') = hash;
                }
HTML;
        return $html;
    }

    public function getUserFromAuth()
    {
        $challenge = $_SESSION[SESSION_CHALLENGE_KEY];
        $code = empty($_POST[CODE_INPUT_NAME]) ? null : $_POST[CODE_INPUT_NAME];

        $stmt = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * 
        FROM utilisateur 
        WHERE SHA512(CONCAT(password, :challenge, SHA512(login))) = :code
SQL);
        $stmt->execute(array(
            ':challenge'=>$challenge,
            ':code'=>$code
        ));

        $tableau = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() != 1)
        {
            throw new AuthentificationException("Le login ou le mot de passe n'a pas été trouvé dans la base de données");
        }
        $this->user = new User($tableau);
        $this->setUser($this->user);
        return $this->user;
    }

}