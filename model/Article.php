<?php
namespace Nette\Database;

use \Connection;

class BaseConnection 
{
    /** @var Nette\Database\Context */
        protected $conn;
        
        function __contruct(\Context $conn)
        {
            $this->conn = $conn;
        }
}