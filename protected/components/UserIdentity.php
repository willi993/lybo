<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
        private $id;
	public function authenticate()
	{
            $record = Usuario::model()->findByAttributes(array('usuario'=>$this->username));
            if($record===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            elseif($record->pass!==$this->password)
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else{
                $this->id=$record->id;
                if($record->admin)
                   $this->setState('admin',true);
                $this->setState('nombre', $record->nombre); 
                $this->setState('apellido', $record->apellido);
                
            $this->errorCode=self::ERROR_NONE;
            }
		
            return !$this->errorCode;
	}
        
        public function getId(){
            return $this->id;
        }
        
}