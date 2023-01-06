<?php
namespace Repository;

class BaseRepository extends \Nette\Object
{
    /** @var Nette\Database\Context */
        protected $conn;
     
        
        function __construct(\Nette\Database\Context $conn)
        {
            $this->conn = $conn;
        }
        

        function zeroArray($arr)
        {
            $e = explode("-", $arr);  
            
            if(!is_numeric($e[0]))
            {              
              throw new \Nette\Application\BadRequestException();
            }
            
            return $e[0];
        }


}