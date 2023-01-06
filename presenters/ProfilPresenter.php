<?php

namespace App\Presenters;

use Nette,
	App\Model;


class ProfilPresenter extends BasePresenter
{
    /**
     * @var \Repository\Profil @inject
     */
    
    public $profil;
    
    private $container;    
    
    public function actionDefault($id)
    {
        $this->container = $this->profil->getUser($id);
        
        if($this->container == false)
        {
            throw new \Nette\Application\BadRequestException();
        }
        
    }
    
    function renderDefault($id)
    {
        $this->template->profil = $this->container;
        
        $this->template->books = $this->profil->getBooks($id);
        
        $this->template->galleries = $this->profil->getGalleries($id);
    }
}
