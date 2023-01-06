<?php
namespace Nette\Database;
namespace Repository;


class Profil extends BaseRepository
{
    
    /**
     * 
     * @return Nette\Database\Table\Selection
     */
    
    function getUser($id)
    {
        return $this->conn->table("users")->get($this->zeroArray($id));
    }
    
    function getBooks($id)
    {
        return $this->conn->table("books")->where("id_author", $this->zeroArray($id));
    }
    
    function getGalleries($id)
    {
        return $this->conn->table('galleries')->where('id_author', $this->zeroArray($id));
    }
    
    function getTotalOfPicsInGallery($id, $id_gallery)
    {
        return $this->conn->table('gallery_pictures')->where('id_autor', $this->zeroArray($id))
                                                     ->where('id_gallery', $this->zeroArray($id_gallery))->count('*');
    }

    
}