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
 * The repository for Rankingoptions
 */
class RankingoptionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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

  public function findRankingOptionsForUid($pid)
  {
    $query = $this->createQuery();
    $query->matching($query->equals('pid', $pid));

    return $query->execute();
  }

  public function generateOptionPairs($rankingOptionsSelect)
  {

    $allOptions = [];
    foreach ($rankingOptionsSelect as $rankingOptionUid) {
      $rankingOption = $this->findByUid((int) $rankingOptionUid);
      $allOptions[] = [$rankingOption->getUid(), $rankingOption->getTitle()];
    }

    $countAllOptions = count($allOptions);
    $rankingPairs = [];
    foreach ($allOptions as $i => $option) {
      // $i = counter, $option = array[uid, name]
      for($j = $i + 1; $j < $countAllOptions; $j++) {
        $rankingPairs[] = [$option[0] => $option[1], $allOptions[$j][0] => $allOptions[$j][1]];
      }
    }

    return $rankingPairs;
  }

  public function getWinnerRanking($winnerArray)
  {
    $winnerRanking = [];

    foreach ($winnerArray as $winner) {
      $winnerObject = $this->findByUid($winner);
      $name = $winnerObject->getTitle();
      if ($winnerRanking[$name]) {
        $winnerRanking[$name]++;
      } else {
        $winnerRanking[$name] = 1;
      }
    }

    arsort($winnerRanking, SORT_NUMERIC);

    return $winnerRanking;
  }

}
