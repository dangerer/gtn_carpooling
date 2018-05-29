<?php
namespace GTN\GtnCarpooling\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Sergey Zavarzin <szavarzin@gtn-solutions.com>, Gtn solutions
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
 * Trip
 */
class Trip extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * firstName
     * 
     * @var string
     */
    protected $firstName = '';
    
    /**
     * lastName
     * 
     * @var string
     */
    protected $lastName = '';
    
    /**
     * email
     * 
     * @var string
     */
    protected $email = '';
    
    /**
     * phone
     * 
     * @var string
     */
    protected $phone = '';
    
    /**
     * tripDate
     * 
     * @var \DateTime
     */
    protected $tripDate = null;
    
    /**
     * cityStart
     * 
     * @var string
     */
    protected $cityStart = '';
    
    /**
     * cityDestination
     * 
     * @var string
     */
    protected $cityDestination = '';
    
    /**
     * publishHash
     * 
     * @var string
     */
    protected $publishHash = '';
    
    /**
     * deleteHash
     * 
     * @var string
     */
    protected $deleteHash = '';
    
    /**
     * zipStart
     * 
     * @var int
     */
    protected $zipStart = 0;
    
    /**
     * zipDestination
     * 
     * @var int
     */
    protected $zipDestination = 0;

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * hidden
     *
     * @var integer
     */
    protected $hidden = 0;

	 /**
     * hasNeed
     *
     * @var integer
     */
	protected $hasNeed = 0;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @inject
     */
    protected $objectManager;

    /*public function initializeObject() {
//        echo '1111';
        $this->cityDestination = '123456';
    }*/

	
	 /**
     * Returns the has needed property
     * 
     * @return integer $hasNeed
     */
	public function getHasNeed()
	{
		return $this->hasNeed;
	}
	
	/**
     * Sets hasNeed
     * 
     * @param integer $hasNeed
     * @return void
     */
	public function setHasNeed($hasNeed)
	{
		$this->hasNeed = $hasNeed;
	}
	
    /**
     * Returns the firstName
     * 
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the firstName
     * 
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * Returns the lastName
     * 
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the lastName
     * 
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns the phone
     * 
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Sets the phone
     * 
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * Returns the tripDate
     * 
     * @return \DateTime $tripDate
     */
    public function getTripDate()
    {
        return $this->tripDate;
    }
    
    /**
     * Sets the tripDate
     * 
     * @param \DateTime $tripDate
     * @return void
     */
    public function setTripDate($tripDate)
    {
        $this->tripDate = $tripDate;
    }
    
    /**
     * Returns the cityStart
     * 
     * @return string $cityStart
     */
    public function getCityStart()
    {
        return $this->cityStart;
    }
    
    /**
     * Sets the cityStart
     * 
     * @param string $cityStart
     * @return void
     */
    public function setCityStart($cityStart)
    {
        $this->cityStart = $cityStart;
    }
    
    /**
     * Returns the cityDestination
     * 
     * @return string $cityDestination
     */
    public function getCityDestination()
    {
        return $this->cityDestination;
    }
    
    /**
     * Sets the cityDestination
     * 
     * @param string $cityDestination
     * @return void
     */
    public function setCityDestination($cityDestination)
    {
        $this->cityDestination = $cityDestination;
    }
    
    /**
     * Returns the publishHash
     * 
     * @return string $publishHash
     */
    public function getPublishHash()
    {
        return $this->publishHash;
    }
    
    /**
     * Sets the publishHash
     * 
     * @param string $publishHash
     * @return void
     */
    public function setPublishHash($publishHash)
    {
        $this->publishHash = $publishHash;
    }
    
    /**
     * Returns the deleteHash
     * 
     * @return string $deleteHash
     */
    public function getDeleteHash()
    {
        return $this->deleteHash;
    }
    
    /**
     * Sets the deleteHash
     * 
     * @param string $deleteHash
     * @return void
     */
    public function setDeleteHash($deleteHash)
    {
        $this->deleteHash = $deleteHash;
    }
    
    /**
     * Returns the zipStart
     * 
     * @return int $zipStart
     */
    public function getZipStart()
    {
        return $this->zipStart;
    }
    
    /**
     * Sets the zipStart
     * 
     * @param int $zipStart
     * @return void
     */
    public function setZipStart($zipStart)
    {
        $this->zipStart = $zipStart;
    }
    
    /**
     * Returns the zipDestination
     * 
     * @return int $zipDestination
     */
    public function getZipDestination()
    {
        return $this->zipDestination;
    }
    
    /**
     * Sets the zipDestination
     * 
     * @param int $zipDestination
     * @return void
     */
    public function setZipDestination($zipDestination)
    {
        $this->zipDestination = $zipDestination;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    public function getPublishLink() {
        /* @var \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder $uriBuilder */
//        $uriBuilder = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder');
//        $uriBuilder->set
//        $link = $uriBuilder->buildFrontendUri();
//        echo $link;
//        exit;
//        $link = $this->u
//        $link = '1111';
//        return $link;
    }

}