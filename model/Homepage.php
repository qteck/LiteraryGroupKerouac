<?php
namespace Repository;

class Article extends BaseRepository
{
    function get__CLASS__ ()
    {
        return $this->conn->table('article')->order('id DESC')->limit(5);
    }
}