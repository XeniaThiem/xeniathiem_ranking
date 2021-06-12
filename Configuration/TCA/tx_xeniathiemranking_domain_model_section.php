<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:xeniathiem_ranking/Resources/Private/Language/locallang_db.xlf:tx_xeniathiemranking_domain_model_section',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,link',
        'iconfile' => 'EXT:xeniathiem_ranking/Resources/Public/Icons/actions-template.svg'
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, rankingoptions, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_xeniathiemranking_domain_model_rankingoption',
                'foreign_table_where' => 'AND {#tx_xeniathiemranking_domain_model_rankingoption}.{#pid}=###CURRENT_PID### AND {#tx_xeniathiemranking_domain_model_rankingoption}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:xeniathiem_ranking/Resources/Private/Language/locallang.xlf:tx_xeniathiemranking_domain_model_section.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'rankingoptions' => [
          'exclude' => true,
          'label' => 'LLL:EXT:xeniathiem_ranking/Resources/Private/Language/locallang.xlf:tx_xeniathiemranking_domain_model_section.rankingoptions',
          'config' => [
              'type' => 'inline',
              'foreign_table' => 'tx_xeniathiemranking_domain_model_rankingoption',
              'foreign_field' => 'parentid',
              'foreign_table_field' => 'parenttable',
              'appearance' => [
                'collapseAll' => true
              ],
          ],
        ],
        'parentid' => [
          'exclude' => true,
          'label' => 'parentid',
          'config' => [
            'type' => 'passthrough',
          ],
        ],
        'parenttable' => [
          'exclude' => true,
          'label' => 'parenttable',
          'config' => [
            'type' => 'passthrough',
          ],
        ],
    ],
];
