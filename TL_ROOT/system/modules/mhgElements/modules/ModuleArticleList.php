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

namespace mhg;


/**
 * Class ModuleArticleList
 *
 * Front end module "article list" extended.
 */
class ModuleArticleList extends \Contao\ModuleArticleList {

    /**
     * Generate the module
     */
    protected function compile() {
        global $objPage;

        if (!strlen($this->inColumn)) {
            $this->inColumn = 'main';
        }

        $intCount = 0;
        $articles = array();
        $id = $objPage->id;

        $this->Template->request = \Environment::get('request');

        // Show the articles of a different page
        if ($this->defineRoot && $this->rootPage > 0) {
            if (($objTarget = $this->objModel->getRelated('rootPage')) !== null) {
                $id = $objTarget->id;
                $this->Template->request = $this->generateFrontendUrl($objTarget->row());
            }
        }

        // Get published articles
        $objArticles = \ArticleModel::findPublishedByPidAndColumn($id, $this->inColumn);

        if ($objArticles === null) {
            return;
        }

        while ($objArticles->next()) {
            // Skip first article
            if (++$intCount <= intval($this->skipFirst)) {
                continue;
            }

            // skip hidden articles
            if ($objArticles->hide) {
                continue;
            }

            $cssID = deserialize($objArticles->cssID, true);
            $alias = $objArticles->alias ? : $objArticles->title;

            $articles[] = array
                (
                'link' => $objArticles->title,
                'title' => specialchars($objArticles->title),
                'id' => $cssID[0] ? : standardize($alias),
                'cssClass' => specialchars($cssID[1]),
                'articleId' => $objArticles->id
            );
        }

        $countArticles = count($articles);
        foreach ($articles as $i => $article) {
            $class = '';
            if ($i === 0) {
                $class = 'first';
            } elseif ($i + 1 === $countArticles) {
                $class = 'last';
            }

            if ($class !== '') {
                $articles[$i]['cssClass'] .= ($article['cssClass'] ? ' ' : '') . $class;
            }
        }

        $this->Template->articles = $articles;
    }
}
