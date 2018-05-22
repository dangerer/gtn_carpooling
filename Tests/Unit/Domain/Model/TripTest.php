<?php

namespace GTN\GtnCarpooling\Tests\Unit\Domain\Model;

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
 * Test case for class \GTN\GtnCarpooling\Domain\Model\Trip.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sergey Zavarzin <szavarzin@gtn-solutions.com>
 */
class TripTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \GTN\GtnCarpooling\Domain\Model\Trip
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \GTN\GtnCarpooling\Domain\Model\Trip();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName()
	{
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName()
	{
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail()
	{
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPhone()
		);
	}

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone()
	{
		$this->subject->setPhone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'phone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTripDateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getTripDate()
		);
	}

	/**
	 * @test
	 */
	public function setTripDateForDateTimeSetsTripDate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setTripDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'tripDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityStartReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCityStart()
		);
	}

	/**
	 * @test
	 */
	public function setCityStartForStringSetsCityStart()
	{
		$this->subject->setCityStart('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cityStart',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipStartReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setZipStartForIntSetsZipStart()
	{	}

	/**
	 * @test
	 */
	public function getCityDestinationReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCityDestination()
		);
	}

	/**
	 * @test
	 */
	public function setCityDestinationForStringSetsCityDestination()
	{
		$this->subject->setCityDestination('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cityDestination',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipDestinationReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setZipDestinationForIntSetsZipDestination()
	{	}

	/**
	 * @test
	 */
	public function getPublishHashReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPublishHash()
		);
	}

	/**
	 * @test
	 */
	public function setPublishHashForStringSetsPublishHash()
	{
		$this->subject->setPublishHash('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'publishHash',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDeleteHashReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDeleteHash()
		);
	}

	/**
	 * @test
	 */
	public function setDeleteHashForStringSetsDeleteHash()
	{
		$this->subject->setDeleteHash('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'deleteHash',
			$this->subject
		);
	}
}
