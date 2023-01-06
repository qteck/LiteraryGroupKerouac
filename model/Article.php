<?php
namespace Nette\Database;
namespace Repository;


class Article extends BaseRepository
{
    
    /**
     * 
     * @return Nette\Database\Table\Selection
     */
    
    function getArticle($id)
    {
        return $this->conn->table("articles")->get($this->zeroArray($id));
    }
    

    
}