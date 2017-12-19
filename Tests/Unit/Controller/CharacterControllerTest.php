<?php
namespace Sc\Dsachars\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Sebastian Christoph <mail@sebastian-christoph.de>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Sc\Dsachars\Controller\CharacterController.
 *
 * @author Sebastian Christoph <mail@sebastian-christoph.de>
 */
class CharacterControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Sc\Dsachars\Controller\CharacterController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Sc\\Dsachars\\Controller\\CharacterController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCharactersFromRepositoryAndAssignsThemToView()
	{

		$allCharacters = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$characterRepository = $this->getMock('Sc\\Dsachars\\Domain\\Repository\\CharacterRepository', array('findAll'), array(), '', FALSE);
		$characterRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCharacters));
		$this->inject($this->subject, 'characterRepository', $characterRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('characters', $allCharacters);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCharacterToView()
	{
		$character = new \Sc\Dsachars\Domain\Model\Character();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('character', $character);

		$this->subject->showAction($character);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCharacterToCharacterRepository()
	{
		$character = new \Sc\Dsachars\Domain\Model\Character();

		$characterRepository = $this->getMock('Sc\\Dsachars\\Domain\\Repository\\CharacterRepository', array('add'), array(), '', FALSE);
		$characterRepository->expects($this->once())->method('add')->with($character);
		$this->inject($this->subject, 'characterRepository', $characterRepository);

		$this->subject->createAction($character);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCharacterToView()
	{
		$character = new \Sc\Dsachars\Domain\Model\Character();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('character', $character);

		$this->subject->editAction($character);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCharacterInCharacterRepository()
	{
		$character = new \Sc\Dsachars\Domain\Model\Character();

		$characterRepository = $this->getMock('Sc\\Dsachars\\Domain\\Repository\\CharacterRepository', array('update'), array(), '', FALSE);
		$characterRepository->expects($this->once())->method('update')->with($character);
		$this->inject($this->subject, 'characterRepository', $characterRepository);

		$this->subject->updateAction($character);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenCharacterFromCharacterRepository()
	{
		$character = new \Sc\Dsachars\Domain\Model\Character();

		$characterRepository = $this->getMock('Sc\\Dsachars\\Domain\\Repository\\CharacterRepository', array('remove'), array(), '', FALSE);
		$characterRepository->expects($this->once())->method('remove')->with($character);
		$this->inject($this->subject, 'characterRepository', $characterRepository);

		$this->subject->deleteAction($character);
	}
}
