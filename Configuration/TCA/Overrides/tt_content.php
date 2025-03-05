<?php

declare(strict_types=1);

defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * Register Plugin
 */
ExtensionUtility::registerPlugin(
    'Bluesky',
    'List',
    'LLL:EXT:bluesky/Resources/Private/Language/locallang_db.xlf:plugin.list.title',
    'extension-bluesky',
    'plugins',
    'LLL:EXT:bluesky/Resources/Private/Language/locallang_db.xlf:plugin.list.description'
);

/**
 * Include Flexform
 */
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform,pages,recursive,',
    'bluesky_list',
    'after:subheader',
);
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:bluesky/Configuration/FlexForms/List.xml',
    'bluesky_list'
);
