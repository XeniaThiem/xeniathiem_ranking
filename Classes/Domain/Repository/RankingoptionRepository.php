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

  public function findRankingOptionsBySection($sectionUid, $pid)
  {
    $query = $this->createQuery();
    $constraints = [];
    $constraints[] = $query->equals('pid', $pid);
    $constraints[] = $query->equals('parentid', $sectionUid);
    $query->matching($query->logicalAnd($constraints));

    return $query->execute();
  }

  public function generateOptionPairs($rankingOptionsSelect)
  {

    $allOptions = [];
    foreach ($rankingOptionsSelect as $rankingOptionUid) {
      $rankingOption = $this->findByUid((int) $rankingOptionUid);
      $name = $this->getTitleInclCollection($rankingOption);
      $allOptions[] = [$rankingOption->getUid(), $name];
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

  public function getTitleInclCollection($object)
  {
    $name = $object->getTitle();
    $collectiondisplay = $object->getCollectiondisplay();
    $collection = $object->getCollection();
    if ($collectiondisplay === 2 && $collection !== '') {
      $name = $collection . ' - ' . $name;
    } else if ($collectiondisplay === 3 && $collection !== '') {
      $name = $name . ' (' . $collection . ')';
    }
    return $name;
  }

  public function getWinnerRanking($winnerArray, $allUids)
  {
    $winnerRanking = [];

    foreach ($winnerArray as $winner) {
      $winnerObject = $this->findByUid($winner);
      $name = $this->getTitleInclCollection($winnerObject);
      if ($winnerRanking[$name]) {
        $winnerRanking[$name]++;
      } else {
        $winnerRanking[$name] = 1;
      }
    }

    foreach ($allUids as $uid) {
      if (!in_array($uid, $winnerArray)) {
        $zeroPointObject = $this->findByUid($uid);
        $name = $this->getTitleInclCollection($zeroPointObject);
        $winnerRanking[$name] = 0;
      }
    }

    arsort($winnerRanking, SORT_NUMERIC);

    return $winnerRanking;
  }

  public function getCollectionRanking($winnerArray, $allUids)
  {
    $collectionRanking = [];

    foreach ($winnerArray as $winner) {
      $winnerObject = $this->findByUid($winner);
      $collection = $winnerObject->getCollection();
      if ($collection !== '') {
        if ($collectionRanking[$collection]) {
          $collectionRanking[$collection]++;
        } else {
          $collectionRanking[$collection] = 1;
        }
      }
    }

    foreach ($allUids as $uid) {
      $zeroPointObject = $this->findByUid($uid);
      $collectionName = $zeroPointObject->getCollection();
      if (!array_key_exists($collectionName, $collectionRanking) && $collectionName !== '') {
        $collectionRanking[$collectionName] = 0;
      }
    }

    arsort($collectionRanking, SORT_NUMERIC);

    return $collectionRanking;
  }


}
