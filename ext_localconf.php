<?php
defined('TYPO3_MODE') || die();

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'XeniathiemRanking',
            'Rankingtool',
            [
                \Xeniathiem\XeniathiemRanking\Controller\RankingController::class => 'rankingtool'
            ],
            // non-cacheable actions
            [

            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'XeniathiemRanking',
            'Ajax',
            [
                \Xeniathiem\XeniathiemRanking\Controller\AjaxController::class => 'loadPairs, showWinner'
            ],
            // non-cacheable actions
            [

            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        rankingtool {
                            iconIdentifier = xeniathiem_ranking-plugin-rankingtool
                            title = LLL:EXT:xeniathiem_ranking/Resources/Private/Language/locallang_db.xlf:tx_xeniathiem_ranking_rankingtool.name
                            description = LLL:EXT:xeniathiem_ranking/Resources/Private/Language/locallang_db.xlf:tx_xeniathiem_ranking_rankingtool.description
                            tt_content_defValues {
                                CType = list
                                list_type = xeniathiemranking_rankingtool
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

			$iconRegistry->registerIcon(
				'xeniathiem_ranking-plugin-rankingtool',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:xeniathiem_ranking/Resources/Public/Icons/user_plugin_rankingtool.svg']
			);

    }
);
