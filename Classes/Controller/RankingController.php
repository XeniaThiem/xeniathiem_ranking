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

use Xeniathiem\XeniathiemRanking\Domain\Repository\RankingoptionRepository;
use Xeniathiem\XeniathiemRanking\Domain\Repository\SectionRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

/**
 * RankingController
 */
class RankingController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * rankingoptionRepository
     *
     * @var RankingoptionRepository
     */
    protected $rankingoptionRepository;

    /**
     * sectionRepository
     *
     * @var SectionRepository
     */
    protected $sectionRepository;

    /**
    * @var ConfigurationManager
    */
    protected $configurationManager;

    public function __construct(RankingoptionRepository $rankingoptionRepository, SectionRepository $sectionRepository, ConfigurationManager $configurationManager)
    {
      $this->rankingoptionRepository = $rankingoptionRepository;
      $this->sectionRepository = $sectionRepository;
      $this->ConfigurationManager = $configurationManager;
    }

    /**
     * @return string|object|null|void
     */
    public function rankingtoolAction()
    {

      $title = $this->settings['title'];
      $subtitle = $this->settings['subtitle'];
      $descriptionOne = $this->settings['descriptionone'];
      $descriptionTwo = $this->settings['descriptiontwo'];
      $descriptionThree = $this->settings['descriptionthree'];

      $pid = $this->ConfigurationManager->getContentObject()->data['pid'];

      $rankingOptions = [];
      $sections = $this->sectionRepository->findSectionsByPid($pid);

      if (count($sections) > 0) {
        foreach ($sections as $section) {
          $rankingOptions[] = $this->rankingoptionRepository->findRankingOptionsBySection($section->getUid(), $pid);
        }
      }

      $sectionCount = count($sections);

      $this->view->assignMultiple([
        'title' => $title,
        'subtitle' => $subtitle,
        'descriptionone' => $descriptionOne,
        'descriptiontwo' => $descriptionTwo,
        'descriptionthree' => $descriptionThree,
        'rankingOptions' => $rankingOptions,
        'sections' => $sections,
        'sectionCount' => $sectionCount
      ]);
    }

}
