<?php
namespace Sc\Dsachars\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Sebastian Christoph <mail@sebastian-christoph.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * CharacterController
 */
class CharacterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    protected $customUserID = 0;
  
    /**
     * characterRepository
     *
     * @var \Sc\Dsachars\Domain\Repository\CharacterRepository
     * @inject
     */
    protected $characterRepository = NULL;
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $this->customUserID = $GLOBALS['TSFE']->fe_user->user['uid'];
        $characters = $this->characterRepository->findByFeuserID($this->customUserID);
        //$characters = $this->characterRepository->findAll();
        $this->view->assign('characters', $characters);
    }
    
    /**
     * action show
     *
     * @param \Sc\Dsachars\Domain\Model\Character $character
     * @return void
     */
    public function showAction(\Sc\Dsachars\Domain\Model\Character $character)
    {
        $this->view->assign('character', $character);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        
    }
    
    /**
     * action create
     *
     * @param \Sc\Dsachars\Domain\Model\Character $newCharacter
     * @return void
     */
    public function createAction(\Sc\Dsachars\Domain\Model\Character $newCharacter)
    {
        $this->customUserID = $GLOBALS['TSFE']->fe_user->user['uid'];
        //$newCharacter->feuserID = $this->customUserID;
        $newCharacter->setFeuserID($this->customUserID);
        //var_dump($newCharacter);die;
      
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->characterRepository->add($newCharacter);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \Sc\Dsachars\Domain\Model\Character $character
     * @ignorevalidation $character
     * @return void
     */
    public function editAction(\Sc\Dsachars\Domain\Model\Character $character)
    {
        $this->view->assign('character', $character);
    }
    
    /**
     * action update
     *
     * @param \Sc\Dsachars\Domain\Model\Character $character
     * @return void
     */
    public function updateAction(\Sc\Dsachars\Domain\Model\Character $character)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->characterRepository->update($character);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \Sc\Dsachars\Domain\Model\Character $character
     * @return void
     */
    public function deleteAction(\Sc\Dsachars\Domain\Model\Character $character)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->characterRepository->remove($character);
        $this->redirect('list');
    }

}