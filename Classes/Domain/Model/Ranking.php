<?php

declare(strict_types=1);

namespace Xeniathiem\XeniathiemRanking\Domain\Model;


/**
 * This file is part of the "Xenia Thiem Rankingtool" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Xenia Thiem <xt@xeniathiem.de>
 */


/**
 * Ranking
 */
class Ranking extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
  /**
  * @var array
  */
  protected $rankingoptions;

  /**
  * @var array
  */
  protected $rankingpairs;

  /**
  * @var \Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption
  */
  protected $winner;

  /**
  * @var int
  */
  protected $step = 0;

  /**
   * @return array
   */
  public function getRankingoptions()
  {
     return $this->rankingoptions;
  }

  /**
   * @param array
   * @return void
   */
  public function setRankingoptions(array $rankingoptions)
  {
     $this->rankingoptions = $rankingoptions;
  }

  /**
   * @return array
   */
  public function getRankingpairs()
  {
     return $this->rankingpairs;
  }

  /**
   * @param array
   * @return void
   */
  public function setRankingpairs(array $rankingpairs)
  {
     $this->rankingpairs = $rankingpairs;
  }

  /**
   * @return \Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption
   */
  public function getWinner()
  {
    return $this->winner;
  }

  /**
   * @param \Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption
   * @return void
   */
  public function setWinner(\Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption $winner)
  {
    $this->winner = $winner;
  }

  /**
   * @return int
   */
  public function getStep()
  {
    return $this->step;
  }

  /**
   * @param int
   * @return void
   */
  public function setStep(int $step)
  {
    $this->step = $step;
  }

}
