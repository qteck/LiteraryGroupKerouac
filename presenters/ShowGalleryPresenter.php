<?php

namespace App\Presenters;

use Nette,
	App\Model;


class UkazGaleriiPresenter extends BasePresenter
{
    /**
     * @var \Repository\ShowGallery @inject
     */
    
    public $pictures;
    protected $container;
    
    public function actionDefault($id)
    {
        $this->container = $this->pictures->getGallery($id);
        if($this->container == false)
            {
                throw new \Nette\Application\BadRequestException();
            }
    }
    
    
    public function renderDefault($id)
    {
        
        $this->template->gallery = $this->container;
        $this->template->pictures = $this->pictures->getPictures($id);
        
        if(count($this->template->pictures) == 0)
            { 
                $this->flashMessage('Galerie je prozatím bez obsahu.', 'info');
            }
    }

}
