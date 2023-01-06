<?php


namespace App\Presenters;

use Nette,
	App\Model,
        Nette\Application\UI\Form;

use Nette\Image;



class UploadPresenter extends BasePresenter
{
        /**
         *
         * @var \Repository\Upload @inject
         */
        public $upload;
        
            public function actionDefault()
            {
                if(!$this->user->isLoggedIn())
                {
                    $this->redirect('Login:default');
                }
            }

            
            function createComponentUploadForm()
            {
                $form = new Form;
                $form->addSelect('gallery', 'Přiřadit galerii: ', $this->upload->getGalleries());
                $form->addText('id_author','Tvoje ID')
                     ->addRule($form::FILLED);
                $form->setDefaults(array('id_author' => $this->user->getIdentity()->id));
                
                $form->addUpload('img','Snímky: ', true)
                        ->addRule($form::FILLED, 'Je potřeba vybrat nějaké snímky.')
                            ->addRule(Form::IMAGE, 'Obrázek může být pouze ve formátu jpg, png nebo gif.')
                                ->addRule(Form::MAX_FILE_SIZE,'Velikost snímku nesmí překročit 2 mb.', 2*1048576);
                $form->addSubmit('upload', 'Nahrát');
            
                $form->onSuccess[] = array($this, 'UploadFormSubmitted');
                
                return $form;
            }
            
            
            function UploadFormSubmitted(Form $form)
            {
                $valuesOfForm = $form->getValues();
                $path_original = 'images/galleries/'.$valuesOfForm->gallery.'/original/';
                $path_resized = 'images/galleries/'.$valuesOfForm->gallery.'/resized/';
                
                $newNameId = $this->upload->getIdOfLastPic()-1;
                
                foreach($valuesOfForm->img as $img)
                    {                   
                    
                    $newNameId++;
                    
                    if(!is_dir($path_original) or !is_dir($path_resized))
                        {  
                            $handle_dir = mkdir($path_original, 0755, true);
                            $handle_dir2 = mkdir($path_resized, 0755, true);
                        } 
                     else 
                        { 
                            $handle_dir = $handle_dir2 = true; 
                        }
                  
                    if($handle_dir && $handle_dir2)
                        {
                           $movedSuccessfully = move_uploaded_file($img->temporaryFile, $path_original.$img->name);
                        }
                    
                    if($movedSuccessfully)
                        {
                            $type = explode('.', $img->name);
                           
                            $newName = $newNameId . '.' . \Nette\Utils\Strings::lower(end($type));
                                                        
                            rename($path_original . $img->name , $path_original . $newName); 
                            $this->upload->insertPic($newName, $valuesOfForm->id_author, $valuesOfForm->gallery);
                            
                            
                            $imgResize = \Nette\Image::fromFile($path_original . $newName);
                            $imgResize->resize(197, NULL);
                            $imgResize->sharpen();
                            $imgResize->save($path_resized. $newName,80);
                        }
                    
                    }
                    
                $this->flashMessage('Upload proběhl úspěšně!', 'info');
            
	}
        
	public function renderDefault()
	{
        }

}
