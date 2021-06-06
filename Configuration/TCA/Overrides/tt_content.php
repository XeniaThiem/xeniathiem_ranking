<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'XeniathiemRanking',
    'Rankingtool',
    'rankingtool'
);

$flexforms = [
  'xeniathiemranking_rankingtool' => '/Configuration/FlexForm/Rankingtool.xml'
];

foreach ($flexforms as $pluginSignature => $path) {

  $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';

  $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
      $pluginSignature,
      // Flexform configuration schema file
      'FILE:EXT:xeniathiem_ranking' . $path
  );
}
