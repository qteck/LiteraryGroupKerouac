<?php

namespace Repository;


use Nette,
	Nette\Utils\Strings,
	Nette\Security\Passwords;


/**
 * Authenticator overridden by nette
 */

class Auth extends BaseRepository implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'name',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_ROLE = 'role';


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->conn->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('Uvedené jmeno je nesprávné.', self::IDENTITY_NOT_FOUND);

		} elseif (md5($password) != $row[self::COLUMN_PASSWORD_HASH]) {
			throw new Nette\Security\AuthenticationException('Zadané heslo je nesprávné.', self::INVALID_CREDENTIAL);

		}

		$arr = $row->toArray();
                
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return void
	 */
        
	public function add($username, $password)
	{
		$this->conn->table(self::TABLE_NAME)->insert(array(
			self::COLUMN_NAME => $username,
			self::COLUMN_PASSWORD_HASH => md5($password),
		));
	}

}
