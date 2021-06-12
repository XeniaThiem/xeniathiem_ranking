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
 * Section
 */
class Section extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
    * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption>
    */
    protected $rankingoptions;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param \Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption
     * @return void
     */
    public function addRankingoption(Rankingoption $Rankingoption)
    {
       $this->rankingoptions->attach($rankingoption);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Xeniathiem\XeniathiemRanking\Domain\Model\Rankingoption>
     */
    public function getRankingoptions()
    {
       return $this->rankingoptions;
    }
}
