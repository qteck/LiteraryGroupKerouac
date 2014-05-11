<?php
namespace Repository;

class BaseRepository 
{
    /** @var Nette\Database\Context */
        protected $conn;
        
        function __contruct(Nette\Database\Context $conn)
        {
           $this->conn = $conn;
        }
}