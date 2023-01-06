<?php

namespace App\Presenters;

use Nette,
	App\Model;


class GaleriePresenter extends BasePresenter
{
    
   /**
     * @var \Repository\Galleries @inject
     */
    
    public $galleries;
    
    function renderDefault()
    {
        $this->template->galleries = $this->galleries->getGalleries();
        
        if(count($this->template->galleries) == 0)
            {
              $this->flashMessage('Prozatím neexistují žádné galerie.','info');
            }
    }
}
