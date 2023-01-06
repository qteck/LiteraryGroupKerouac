<?php
namespace Nette\Database;
namespace Repository;


class Upload extends BaseRepository
{
    
    /**
     * 
     * @return Nette\Database\Table\Selection
     */
    
    function getGalleries()
    {
        return $this->conn->table("galleries")->fetchPairs('id','name');
    }
    
    function getIdOfLastPic()
    {
        $lastId = $this->conn->query("SELECT AUTO_INCREMENT
                                      FROM  INFORMATION_SCHEMA.TABLES 
                                      WHERE TABLE_NAME   = 'gallery_pictures'")->fetch();
        
        return $lastId->AUTO_INCREMENT;
    }
    
    function insertPic($name, $id_author, $id_gallery)
    {
        $this->conn->table('gallery_pictures')->insert(
                array(
                    'name' => $name,
                    'id_author' => $id_author,
                    'id_gallery' => $id_gallery,
                    'added' => new \Nette\Database\SqlLiteral('NOW()')
                )
                );
    }
    

    
}