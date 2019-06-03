<?php


class Shopware_Controllers_Widgets_FeaturedProductsList extends Enlight_Controller_Action
{
    const PLUGIN_NAME = 'FeaturedProductsPlugin';

    public function productsListAction()
    {
        $pluginConfig = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName(self::PLUGIN_NAME);

        if (!$pluginConfig['display_featured_products']) {
            return;
        }

        $modelsResource = $this->container->get('models');
        $builder = $modelsResource->createQueryBuilder();
        $articles = $builder->select('article')
            ->from('Shopware\Models\Article\Article', 'article')
            ->innerJoin('Shopware\Models\Attribute\Article', 'attribute')
            ->where('attribute.isFeatured = :isFeatured')
            ->andWhere('attribute.articleDetailId = article.mainDetailId')
            ->setParameter('isFeatured', 1)
            ->setMaxResults($pluginConfig['number_of_products'])
            ->getQuery()
            ->getArrayResult();

        $result = [];

        foreach ($articles as $article) {
            $result[] = $product = Shopware()->Modules()->Articles()->sGetArticleById($article['id']);
        }
        
        return $this->View()->assign('articles', $result);
    }
}