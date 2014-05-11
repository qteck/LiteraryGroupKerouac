<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class ArticlePresenter extends BasePresenter
{
    
        /** @var Nette\Database\Context */
    
        protected $conn;
        
        
        function __construct(Nette\Database\Context $conn)
        {
            $this->conn = $conn;
        }
        
	public function renderDefault()
	{
		$this->template->article = $this->conn->table('article')->order('id DESC')->limit(5);
	}

}
