<?php
namespace GTN\GtnCarpooling\Domain\Repository;

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
 * The repository for Trips
 */
class TripRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    protected $defaultOrderings = array('tripDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    public function findFuture() {
        $query = $this->createQuery();
        $now = new \DateTime();
        $query->matching(
            $query->greaterThanOrEqual('tripDate', $now)
        );
        return $query->execute();
    }

    public function findByUidWithHidden($uid) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true)->setIncludeDeleted(false);
        $query->matching(
            $query->equals('uid', $uid)
        );
        return $query->execute()->getFirst();
    }
    
}