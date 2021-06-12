<?php

declare(strict_types=1);

namespace Xeniathiem\XeniathiemRanking\Domain\Repository;


/**
 * This file is part of the "Xenia Thiem Rankingtool" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Xenia Thiem <xt@xeniathiem.de>
 */

use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * The repository for Sections
 */
class SectionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

  /**
  * @var Typo3QuerySettings
  */
  protected $querySettings;

  public function __construct(ObjectManagerInterface $objectManager, Typo3QuerySettings $querySettings)
  {
    parent::__construct($objectManager);
    $this->querySettings = $querySettings;
  }

  public function initializeObject() {
    $this->querySettings->setRespectStoragePage(false);
    $this->setDefaultQuerySettings($this->querySettings);
  }

  public function findSectionsByPid($pid)
  {
    $query = $this->createQuery();
    $query->matching($query->equals('pid', $pid));

    return $query->execute();
  }

}
