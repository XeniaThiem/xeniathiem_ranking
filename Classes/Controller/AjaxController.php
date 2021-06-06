<?php

declare(strict_types=1);

namespace Xeniathiem\XeniathiemRanking\Controller;


/**
 * This file is part of the "Xenia Thiem Rankingtool" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Xenia Thiem <xt@xeniathiem.de>
 */

use Xeniathiem\XeniathiemRanking\Domain\Model\Ranking;
use Xeniathiem\XeniathiemRanking\Domain\Repository\RankingoptionRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

/**
 * AjaxController
 */
class AjaxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * rankingoptionRepository
     *
     * @var RankingoptionRepository
     */
    protected $rankingoptionRepository;

    /**
    * @var ConfigurationManager
    */
    protected $configurationManager;

    public function __construct(RankingoptionRepository $rankingoptionRepository, ConfigurationManager $configurationManager)
    {
      $this->rankingoptionRepository = $rankingoptionRepository;
      $this->ConfigurationManager = $configurationManager;
    }

    /**
     * @return string|object|null|void
     */
    public function loadPairsAction(Ranking $ranking)
    {
      $rankingOptionsSelect = $ranking->getRankingoptions();

      $rankingPairs = $this->rankingoptionRepository->generateOptionPairs($rankingOptionsSelect);

      $this->view->assign('rankingPairs', $rankingPairs);

      $response['html'] = $this->view->render();

      echo json_encode($response);
      exit;
    }

    public function showWinnerAction(Ranking $ranking)
    {
      $winnerArray = $ranking->getRankingpairs();

      $winnerRanking = $this->rankingoptionRepository->getWinnerRanking($winnerArray);

      $this->view->assign('winners', $winnerRanking);

      $response['html'] = $this->view->render();

      echo json_encode($response);
      exit;
    }

}
