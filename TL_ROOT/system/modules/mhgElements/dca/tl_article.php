<?php
/**
 *  Modify palettes 
 */
mhg\Dca::modifyPalette(
    array(
    ',keywords',
    ',author',
    ',inColumn'
    ), array(
    '',
    ',author,keywords',
    ',inColumn,layoutType'
    ), 'tl_article'
);

/**
 * Add fields
 */
mhg\Dca::addField( 'tl_article', 'layoutType',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_article']['layoutType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array( 'tl_article_mhgElements', 'getLayoutTypes' ),
    'reference' => &$GLOBALS['TL_LANG']['tl_article'],
    'sql' => "varchar(32) NOT NULL default ''"
    )
);

/**
 * mhgElements tl_article class
 */
class tl_article_mhgElements extends tl_article
    {


    public function getLayoutTypes()
        {
        $types = array(
            '' => 'default',
            'fullsize' => 'fullsize',
        );

        foreach( $types as $k => $v )
            {
            $types[$k] = &$GLOBALS['TL_LANG']['tl_article']['layoutTypeOptions'][$v];
            }

        return $types;
        }
    }