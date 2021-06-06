<?php
defined('TYPO3_MODE') || die();

call_user_func(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_xeniathiemranking_domain_model_rankingoption', 'EXT:xeniathiem_ranking/Resources/Private/Language/locallang_csh_tx_xeniathiemranking_domain_model_rankingoption.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_xeniathiemranking_domain_model_rankingoption');
});
