<?php

declare(strict_types=1);

use In2code\Bluesky\Controller\ListController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

ExtensionUtility::configurePlugin(
    'Bluesky',
    'List',
    [
        ListController::class => 'list'
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

/**
 * Fluid Namespace
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bsk'][] = 'In2code\Bluesky\ViewHelpers';
