<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class ArticlePresenter extends BasePresenter
{
        /**
        *
        * @var \Repository\Article @inject
        */
        public $article;
        
        private $container;
        
        public function actionDefault($id)
        {
            $this->container = $this->article->getArticle($id);
            if($this->container == false)
            {
                throw new \Nette\Application\BadRequestException();
            }
        }
                
	public function renderDefault($id)
	{
		$this->template->article = $this->container;
	}

}
