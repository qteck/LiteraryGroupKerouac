<?php
namespace Nette\Database;
namespace Repository;


class Galleries extends BaseRepository
{
    
    /**
     * 
     * @return Nette\Database\Table\Selection
     */
    
    
    function getGalleries()
    {
        return $this->conn->table('galleries');
    }   
}