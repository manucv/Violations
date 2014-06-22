<?php

namespace Application\Model;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;

/**
 * Description of Login
 *
 * @author Andres
 */
class Login {

    private $auth;
    private $authAdapter;

    const NOT_IDENTITY = 'notIdentity';
    const INVALID_CREDENTIAL = 'invalidCredential';
    const INVALID_USER = 'invalidUser';
    const INVALID_LOGIN = 'invalidLogin';
    const USER_INACTIVE = 'inactive';

    /**
     * Mensaje de validaciones por defecto
     *
     * @var array
     */
    protected $messages = array(
        self::NOT_IDENTITY => "Not existent identity. A record with the supplied identity could not be found.",
        self::INVALID_CREDENTIAL => "Invalid credential. Supplied credential is invalid.",
        self::INVALID_USER => "Invalid User. Supplied credential is invalid",
        self::INVALID_LOGIN => "Invalid Login. Fields are empty",
    	self::USER_INACTIVE => "The user is inactive."
    );

    public function __construct($dbAdapter) {
        $this->authAdapter = new AuthAdapter($dbAdapter,
                        'usuario',
                        'usu_usuario',
                        'usu_clave');

        $select = $this->authAdapter->getDbSelect();
        //$select->where('usu_estado = 1');
        
        $this->auth = new AuthenticationService();
        
    }

    public function login($username, $password) {

        if (!empty($username) && !empty($password)) {

            $this->authAdapter->setIdentity($username);
            $this->authAdapter->setCredential($password);

            $result = $this->auth->authenticate($this->authAdapter);
            
            switch ($result->getCode()) {
            	
                case Result::FAILURE_IDENTITY_NOT_FOUND:
                	
                    throw new \Exception($this->messages[self::NOT_IDENTITY]);
                    break;

                case Result::FAILURE_CREDENTIAL_INVALID:
                	
                    throw new \Exception($this->messages[self::INVALID_CREDENTIAL]);
                    break;

                case Result::SUCCESS:
                    if ($result->isValid()) {
                        $data = $this->authAdapter->getResultRowObject();
                        $this->auth->getStorage()->write($data);
                    } else {
                        throw new \Exception($this->messages[self::INVALID_USER]);
                    }
                    break;
                    
                default:
                    throw new \Exception($this->messages[self::INVALID_LOGIN]);
                    break;
            }
            
        } else {
            throw new \Exception($this->messages[self::INVALID_LOGIN]);
        }
        return $this;
    }

    public function logout() {
        $this->auth->clearIdentity();
        return $this;
    }

    public function getIdentity() {
        if ($this->auth->hasIdentity()) {
            return $this->auth->getIdentity();
        }
        return null;
    }

    public function isLoggedIn() {
        return $this->auth->hasIdentity();
    }

    /**
     * @param string $messageString
     * @param string $messageKey    OPTIONAL
     * @return UserModel
     * @throws Exception
     */
    public function setMessage($messageString, $messageKey = null) {
        if ($messageKey === null) {
            $keys = array_keys($this->messages);
            $messageKey = current($keys);
        }
        if (!isset($this->messages[$messageKey])) {
            throw new \Exception("No message exists for key '$messageKey'");
        }
        $this->messages[$messageKey] = $messageString;
        return $this;
    }

    /**
     * @param array $messages
     * @return UserModel
     */
    public function setMessages(array $messages) {
        foreach ($messages as $key => $message) {
            $this->setMessage($message, $key);
        }
        return $this;
    }

}