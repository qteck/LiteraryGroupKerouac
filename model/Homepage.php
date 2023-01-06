<?php
namespace Repository;

class Homepage extends BaseRepository
{
    
    function getArticles ($by,$to)
    {
        return $this->conn->table('articles')->order('id DESC')->limit($this->zeroArray($by), $this->zeroArray($to));
    }

    function getTotalOfArticles ()
    {
        return $this->conn->table('articles')->count('*');
    }
    
    function getNamebyId($id)
    {
        return $this->conn->table("users")->get(zeroArray($id));
    }
}