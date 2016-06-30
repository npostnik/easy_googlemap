<?php

namespace Comsolit\EasyGooglemap\ViewHelpers\PageRenderer;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class AddJsFooterInlineCodeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     *
     * @param string $name
     * @return NULL
     */
    public function render($name)
    {
        $pageRenderer = $this->getPageRenderer();

        $block = $this->renderChildren();

        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['easy_googlemap']);
        $defaultApiKey = $extConf['apiKey'];
        if(!empty($this->settings['apiKey'])) {
            $apiKey = $this->settings['apiKey'];
        } else {
            $apiKey = $defaultApiKey;
        }

        $language = '';
        if(!empty($this->settings['language'])) {
            $language = '&language='.$this->settings['language'];
        }
        
        $pageRenderer->addJsLibrary(
            'googlemap',
            'https://maps.googleapis.com/maps/api/js?key='.$apiKey.$language,
            'text/javascript',
            false,
            false,
            '',
            true
        );

        $pageRenderer->addCssFile(
            $this->templateVariableContainer->get('settings')['cssfile'] ?:
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('easy_googlemap') . 'Resources/Public/css/map.css'
        );

        $pageRenderer->addJsFooterInlineCode($name, $block, $compress, $forceOnTop);

        return null;
    }

    /**
     * @return PageRenderer
     */
    private function getPageRenderer()
    {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Page\PageRenderer');
    }
}