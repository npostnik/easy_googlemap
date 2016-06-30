<?php

namespace Comsolit\EasyGooglemap\Userfuncs;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Tca
{
    public function coordinateResolver($PA, $fObj)
    {
        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['easy_googlemap']);
        $apiKey = $extConf['apiKey'];
        if (empty($apiKey)) {
            return 'Please provide a default Google Maps API Key in extension settings. Get it <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">here</a>';
        }
        $out [] = '<div id="map" style="height: 400px;"></div>';
        $out [] = '<script src="https://maps.googleapis.com/maps/api/js?key='.$apiKey.'&language=de-ch"></script>';
        $out [] = '<script type="text/javascript"' . ' src="' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath(easy_googlemap) . 'Resources/Public/jquery/addressMap.js">' . '</script>';
        $out [] = '<script type="text/javascript"' . ' src="' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath(easy_googlemap) . 'Resources/Public/jquery/addressMapConfig.js">' . '</script>';
        return implode('', $out);

    }


    public function urlInput($PA, $fObj)
    {
        $out [] = '<div class="form-control-wrap" style="max-width: 650px">';
        $out [] = '<div class="form-control-clearable">';
        $out [] = '<input type="hidden" class="url-input" value="' . $PA['row']['link'] . '" name="' . $PA['itemFormElName'] . '">';
        $out [] = '</div>';
        $out [] = '</div>';
        $out [] = '<script type="text/javascript"' . ' src="' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath(easy_googlemap) . 'Resources/Public/jquery/urlInput.js">' . '</script>';
        return implode('', $out);
    }
}