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
 * alter DCA pallettes
 */
mhg\Dca::modifyPalette(array(',guests', ',inColumn'), array(',hide,guests', ',inColumn,layoutType'), 'tl_article');


/**
 * add DCA fields
 */
mhg\Dca::addField('tl_article', 'hide', array(
    'label' => &$GLOBALS['TL_LANG']['tl_article']['hide'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default ''"
));


mhg\Dca::addField('tl_article', 'layoutType', array(
    'label' => &$GLOBALS['TL_LANG']['tl_article']['layoutType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_article_mhgElements', 'getLayoutTypes'),
    'reference' => &$GLOBALS['TL_LANG']['tl_article'],
    'sql' => "varchar(32) NOT NULL default ''"
        )
);


/**
 *  Extended tl_article class [mhgElements]
 */
class tl_article_mhgElements extends tl_article {

    /**
     * @param   void
     * @return  array
     */
    public function getLayoutTypes() {
        $arrTypes = array(
            '' => 'default',
            'fullsize' => 'fullsize',
        );

        foreach ($arrTypes as $k => $v) {
            $arrTypes[$k] = &$GLOBALS['TL_LANG']['tl_article']['layoutTypeOptions'][$v];
        }

        return $arrTypes;
    }
}
