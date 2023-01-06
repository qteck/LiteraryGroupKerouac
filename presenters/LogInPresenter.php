<?php

namespace App\Presenters;


use Nette,
	App\Model,
        Nette\Application\UI\Form;

use Nette\Diagnostics\Debugger;


/**
 *  presenter.
 */
class LogInPresenter extends BasePresenter
{
    /**
     *
     * @var \Repository\Auth @inject
     */
    public $logIn;
    
        public function createComponentLogInForm()
        {
            $form = new Form();
            $form->addText('name', 'Jméno: ')
                    ->addRule($form::FILLED, 'Jméno musí být vyplněné.');
            $form->addPassword('psswd', 'Heslo: ')
                    ->addRule($form::FILLED, 'Heslo musí být vyplněné.');
            
            $form->addCheckbox('remember', 'Pamatuj si mě');
            
            $form->addSubmit('login', 'Přihlásit');
            $form->onSuccess[] = array($this, 'logInFormSubmitted');
            
            return $form;
        }
                
        public function logInFormSubmitted(Form $form)
	{
            $values = $form->getValues();
            
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->name, $values->psswd);
			$this->redirect('Homepage:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlo úspěšně.');
		$this->redirect('Homepage:');
	}
        
	public function renderDefault()
	{
           // $this->logIn->add('ahmed','');
            
		$this->template->logIn = '';
	}

}
