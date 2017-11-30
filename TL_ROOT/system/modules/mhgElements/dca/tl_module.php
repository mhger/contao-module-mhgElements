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
        . '{config_legend},articleID,exitintent_steps,exitintent_delay,exitintent_distance,exitintent_scroll,exitintent_timer,exitintent_cookie;'
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

mhg\Dca::addField('tl_module', 'exitintent_steps', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_steps'],
    'default' => '1',
    'exclude' => true,
    'inputType' => 'text',
    'default' => '',
    'eval' => array('rgxp' => 'digit', 'maxlength' => 2, 'tl_class' => 'w50 clr'),
    'sql' => "int(2) unsigned NOT NULL default '1'"
));

mhg\Dca::addField('tl_module', 'exitintent_delay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_delay'],
    'default' => '500',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '500'"
));

mhg\Dca::addField('tl_module', 'exitintent_distance', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_distance'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitintent_scroll', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_scroll'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitintent_timer', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_timer'],
    'default' => '0',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
));

mhg\Dca::addField('tl_module', 'exitintent_cookie', array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['exitintent_cookie'],
    'default' => '1',
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '1'"
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
