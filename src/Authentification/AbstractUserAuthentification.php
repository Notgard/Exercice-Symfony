<?php

namespace App\Authentification;

use App\Authentification\Exception\NotLoggedInException;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;

const SESSION_KEY = '__UserAuthentication__';
const SESSION_USER_KEY = 'user';
const LOGOUT_INPUT_NAME = 'logout';

class AbstractUserAuthentification
{
    private ?Utilisateur $user = null;

    public Request $request;

    protected static function setUser(Utilisateur $user, Request $request)
    {
        $session = $request->getSession();
        $session->set(SESSION_KEY, $user);
    }

    public function loginForm(string $action, string $submitText = "OK")
    {
    }

    public function getUserfromAuth()
    {
    }

    public function isUserConnected() : bool
    {
        $session = $this->request->getSession();
        $bool = $session->get(SESSION_KEY) !== null;
        return $bool;
    }

    public function logoutForm(string $action, string $text = "LOGOUT") : string
    {
        $logout = LOGOUT_INPUT_NAME;
        $html = <<<HTML
            <form method="GET" action="$action" class="bg-dark">
                <button type="submit" name=$logout value="form2.php" class="btn btn-danger"name="submit">$text</button>
            </form>
HTML;
        return $html;
    }

    public function logoutIfRequested() : void
    {
        $session = $this->request->getSession();
        $logout = empty($_GET[LOGOUT_INPUT_NAME]) ? null : $_GET[LOGOUT_INPUT_NAME];
        if ($logout != null) {
            unset($_SESSION[SESSION_KEY]);
            $this->user = null;
            echo "Déconnexion";
        }
    }

    /**
     * @throws NotLoggedInException
     */
    public function getUser() : Utilisateur
    {
        $user  = null;
        if (isset($this->user)) {
            $user = $this->user;
        }
        else{
            throw new NotLoggedInException("Aucun utilisateur presentement connecté");
        }
        return $user;
    }

}