<?php
namespace Nette\Database;
namespace Repository;


class ShowGallery extends BaseRepository
{
    
    /**
     * 
     * @return Nette\Database\Table\Selection
     */
    function getGallery($id)
    {
        return $this->conn->table('galleries')->get($this->zeroArray($id));
    }
    
    function getPictures($id)
    {
        return $this->conn->table('gallery_pictures')->where('id_gallery', $this->zeroArray($id));
    }   
}