<?php
/**
 * Contao 3 Extension [mhgElements]
 *
 * Copyright (c) 2017 Medienhaus Gersöne UG (haftungsbeschränkt) | Pierre Gersöne
 *
 * @package     mhgElements
 * @author      Pierre Gersöne <mail@medienhaus-gersoene.de>
 * @link        https://www.medienhaus-gersoene.de Medienhaus Gersöne - Agentur für Neue Medien: Web, Design & Marketing
 * @license     LGPL-3.0+
 */
/**
 * add DCA palette
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['exitintent'] = '{title_legend},name,headline,type;'
        . '{config_legend},articleID,exitIntentSteps,exitIntentDelay,exitIntentCookie,exitIntentEdge,exitIntentScroll,exitIntentTimer,exitIntentModal,exitIntentTheme;'
        . '{protected_legend:hide},guests,protected;{expert_legend:hide},cssID;';

/**
 * add DCA fields
 */
mhg\Dca::addField('tl_module', 'articleID', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['articleID'],
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_mhgElements', 'getArticleID'),
    'eval' => array('mandatory' => true, 'chosen' => true, 'submitOnChange' => true, 'tl_class' => 'long'),
    'wizard' => array(array('tl_module_mhgElements', 'editArticleID')),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitIntentSteps', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentSteps'],
    'default' => '1',
    'exclude' => true,
    'inputType' => 'text',
    'default' => '',
    'eval' => array('rgxp' => 'digit', 'maxlength' => 2, 'tl_class' => 'w50 clr'),
    'sql' => "int(2) unsigned NOT NULL default '1'"
));

mhg\Dca::addField('tl_module', 'exitIntentDelay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentDelay'],
    'default' => '30',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '30'"
));

mhg\Dca::addField('tl_module', 'exitIntentEdge', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentEdge'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50 clr'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitIntentScroll', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentScroll'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitIntentTimer', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentTimer'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitIntentCookie', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentCookie'],
    'default' => '1',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '1'"
));

mhg\Dca::addField('tl_module', 'exitIntentTheme', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentTheme'],
    'inputType' => 'select',
    'options' => array('default', 'light', 'dark'),
    'reference' => &$GLOBALS['TL_LANG']['MSC']['exitIntentTheme'],
    'eval' => array('tl_class' => 'w50 clr'),
    'sql' => "varchar(25) NOT NULL default 'default'"
));

mhg\Dca::addField('tl_module', 'exitIntentModal', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitIntentModal'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 clr'),
    'sql' => "char(1) NOT NULL default ''"
));


/**
 *  Extended tl_module class [mhgElements]
 */
class tl_module_mhgElements extends tl_module {

    /**
     * Return the edit article alias wizard
     *
     * @param   DataContainer $dc
     * @return  string
     */
    public function editArticleID(DataContainer $dc) {
        return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=article&amp;table=tl_content&amp;id=' . $dc->value . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' . sprintf(specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $dc->value) . '" style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_content']['editalias'][1], $dc->value))) . '\',\'url\':this.href});return false">' . Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top"') . '</a>';
    }

    /**
     * Get all articles and return them as array (article alias)
     *
     * @param   DataContainer $dc
     * @return  array
     */
    public function getArticleID(DataContainer $dc) {
        $arrPids = array();
        $arrAlias = array();

        if (!$this->User->isAdmin) {
            foreach ($this->User->pagemounts as $id) {
                $arrPids[] = $id;
                $arrPids = array_merge($arrPids, $this->Database->getChildRecords($id, 'tl_page'));
            }

            if (empty($arrPids)) {
                return $arrAlias;
            }

            $objAlias = $this->Database->prepare("SELECT a.id, a.pid, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid WHERE a.pid IN(" . implode(',', array_map('intval', array_unique($arrPids))) . ") ORDER BY parent, a.sorting")
                    ->execute();
        } else {
            $objAlias = $this->Database->prepare("SELECT a.id, a.pid, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid ORDER BY parent, a.sorting")
                    ->execute();
        }

        if ($objAlias->numRows) {
            System::loadLanguageFile('tl_article');

            while ($objAlias->next()) {
                $key = $objAlias->parent . ' (ID ' . $objAlias->pid . ')';
                $arrAlias[$key][$objAlias->id] = $objAlias->title . ' (' . ($GLOBALS['TL_LANG']['COLS'][$objAlias->inColumn] ? : $objAlias->inColumn) . ', ID ' . $objAlias->id . ')';
            }
        }

        return $arrAlias;
    }
}
