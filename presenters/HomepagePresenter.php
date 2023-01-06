<?php

namespace App\Presenters;

class HomepagePresenter extends BasePresenter
{
    /** @var \Repository\Homepage @inject */
    public $articles;

    public function renderDefault($page=1)
    {               
        $paginator = new \Nette\Utils\Paginator;
        $paginator->setItemsPerPage(10); // počet položek na stránce
        $paginator->setItemCount($this->articles->getTotalOfArticles()); // celkový počet položek (např. článků)
                
        if ($page < 1 || $page > $paginator->getLastPage()) {
            $page = 1;
        }

        $paginator->setPage($page);

        $this->template->paginator = $paginator;
              
        $this->template->articles = $this->articles->getArticles($paginator->itemsPerPage, $paginator->getOffset());
        
        if(count($this->template->articles) == 0)
            {
                $this->flashMessage('Prozatím neexsituje žádný obsah.', 'info');
            }
                               
    }
    

}