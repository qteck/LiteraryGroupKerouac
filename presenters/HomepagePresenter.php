<?php

namespace App\Presenters;

class HomepagePresenter extends BasePresenter
{
        /** @var Repository\Article @inject */
        public $article;
        
        function __contruct()
        {
            $this->article = $this->article->getArticle();
        }
	public function renderDefault()
	{
            var_dump($this->template->article = $this->article);
	}

}
