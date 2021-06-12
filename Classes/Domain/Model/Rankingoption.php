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
 * Rankingoption
 */
class Rankingoption extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * collection
     *
     * @var string
     */
    protected $collection = '';

    /**
    * @var int
    */
    protected $collectiondisplay;

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    /**
     * link
     *
     * @var string
     */
    protected $link = '';

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
     * Returns the collection
     *
     * @return string $collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets the collection
     *
     * @param string $collection
     * @return void
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Returns the collectiondisplay
     *
     * @return int $collectiondisplay
     */
    public function getCollectiondisplay()
    {
        return $this->collectiondisplay;
    }

    /**
     * Sets the collectiondisplay
     *
     * @param int $collectiondisplay
     * @return void
     */
    public function setCollectiondisplay($collectiondisplay)
    {
        $this->collectiondisplay = $collectiondisplay;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the link
     *
     * @return string $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     *
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }
}
