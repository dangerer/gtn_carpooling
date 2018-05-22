<?php
namespace GTN\GtnCarpooling\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Sergey Zavarzin <szavarzin@gtn-solutions.com>, Gtn solutions
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
 * Test case for class GTN\GtnCarpooling\Controller\TripController.
 *
 * @author Sergey Zavarzin <szavarzin@gtn-solutions.com>
 */
class TripControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \GTN\GtnCarpooling\Controller\TripController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('GTN\\GtnCarpooling\\Controller\\TripController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTripsFromRepositoryAndAssignsThemToView()
	{

		$allTrips = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$tripRepository = $this->getMock('GTN\\GtnCarpooling\\Domain\\Repository\\TripRepository', array('findAll'), array(), '', FALSE);
		$tripRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTrips));
		$this->inject($this->subject, 'tripRepository', $tripRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('trips', $allTrips);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTripToView()
	{
		$trip = new \GTN\GtnCarpooling\Domain\Model\Trip();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('trip', $trip);

		$this->subject->showAction($trip);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTripToTripRepository()
	{
		$trip = new \GTN\GtnCarpooling\Domain\Model\Trip();

		$tripRepository = $this->getMock('GTN\\GtnCarpooling\\Domain\\Repository\\TripRepository', array('add'), array(), '', FALSE);
		$tripRepository->expects($this->once())->method('add')->with($trip);
		$this->inject($this->subject, 'tripRepository', $tripRepository);

		$this->subject->createAction($trip);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTripToView()
	{
		$trip = new \GTN\GtnCarpooling\Domain\Model\Trip();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('trip', $trip);

		$this->subject->editAction($trip);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTripInTripRepository()
	{
		$trip = new \GTN\GtnCarpooling\Domain\Model\Trip();

		$tripRepository = $this->getMock('GTN\\GtnCarpooling\\Domain\\Repository\\TripRepository', array('update'), array(), '', FALSE);
		$tripRepository->expects($this->once())->method('update')->with($trip);
		$this->inject($this->subject, 'tripRepository', $tripRepository);

		$this->subject->updateAction($trip);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTripFromTripRepository()
	{
		$trip = new \GTN\GtnCarpooling\Domain\Model\Trip();

		$tripRepository = $this->getMock('GTN\\GtnCarpooling\\Domain\\Repository\\TripRepository', array('remove'), array(), '', FALSE);
		$tripRepository->expects($this->once())->method('remove')->with($trip);
		$this->inject($this->subject, 'tripRepository', $tripRepository);

		$this->subject->deleteAction($trip);
	}
}
