<?php

namespace TechnologyPlugin;

use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Doctrine\ORM\Tools\SchemaTool;
use TechnologyPlugin\Models\Technology;

/**
 * Shopware-Plugin TechnologyPlugin.
 */
class TechnologyPlugin extends Plugin
{

    public static function getSubscribedEvents()
    {
        return array(
            'Shopware_Controllers_Seo_filterCounts' => 'addTechnologyCount',
            'Shopware_CronJob_RefreshSeoIndex_CreateRewriteTable' => 'createTechnologyRewriteTable',
            'sRewriteTable::sCreateRewriteTable::replace' => 'createTechnologyRewriteTable',
            'Shopware_Components_RewriteGenerator_FilterQuery' => 'filterParameterQuery'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function install(InstallContext $installContext)
    {
        $this->createDatabase();

        $service = $this->container->get('shopware_attribute.crud_service');

        $em = $this->container->get('models');
        $schemaTool = new SchemaTool($em);
        $schemaTool->updateSchema(
            [ $em->getClassMetadata(Technology::class) ],
            true
        );

        $service->update('s_articles_attributes', 'technology', 'multi_selection', [
            'entity' => Technology::class,
            'displayInBackend' => true,
            'label' => 'Technology',
            'custom' => true
        ], null , true);

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
        $installContext->scheduleClearCache(Plugin\Context\InstallContext::CACHE_LIST_ALL);
    }

    public function activate(ActivateContext $activateContext)
    {
        $activateContext->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
    }

    /**
     * Remove widget and remove database schema.
     *
     * @param Plugin\Context\UninstallContext $uninstallContext
     */
    public function uninstall(Plugin\Context\UninstallContext $uninstallContext)
    {
        if (!$uninstallContext->keepUserData()) {
            $this->removeDatabase();
        }
        $dbalConnection = $this->container->get('dbal_connection');
        $dbalConnection->exec(
            "DELETE FROM s_core_rewrite_urls WHERE path LIKE 'technologies/%' "
        );

        $service = $this->container->get('shopware_attribute.crud_service');
        $attributeExists = $service->get('s_articles_attributes', 'technology');

        if($attributeExists === null) {
            return;
        }

        $service->delete('s_articles_attributes','technology');
        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
        $uninstallContext->scheduleClearCache(Plugin\Context\UninstallContext::CACHE_LIST_ALL);
    }

    private function createDatabase()
    {
        $modelManager = $this->container->get('models');
        $tool = new SchemaTool($modelManager);

        $classes = $this->getClasses($modelManager);

        $tool->updateSchema($classes, true);
    }

    private function removeDatabase()
    {
        $modelManager = $this->container->get('models');
        $tool = new SchemaTool($modelManager);

        $classes = $this->getClasses($modelManager);

        $tool->dropSchema($classes);
    }

    /**
     * @param ModelManager $modelManager
     * @return array
     */
    private function getClasses(ModelManager $modelManager)
    {
        return [
            $modelManager->getClassMetadata(Technology::class)
        ];
    }

    public function createTechnologyRewriteTable()
    {
        /** @var \sRewriteTable $rewriteTableModule */
        $rewriteTableModule = Shopware()->Container()->get('modules')->sRewriteTable();
        $rewriteTableModule->sInsertUrl('sViewport=technologies', 'technologies/');

        /** @var QueryBuilder $dbalQueryBuilder */
        $dbalQueryBuilder = Shopware()->Container()->get('dbal_connection')->createQueryBuilder();
        $urls = $dbalQueryBuilder->select('technology.id, technology.url')
            ->from('technology_plugin', 'technology')
            ->execute()
            ->fetchAll(\PDO::FETCH_KEY_PAIR);

        foreach ($urls as $id => $url) {
            $rewriteTableModule->sInsertUrl('sViewport=technologies&sAction=detail&technologyId=' . $id, 'technologies/' . $url);
        }
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return mixed
     */
    public function filterParameterQuery(\Enlight_Event_EventArgs $args)
    {
        $orgQuery = $args->getReturn();
        $query = $args->getQuery();

        if ($query['controller'] === 'technologies' && isset($query['technologyId'])) {
            $orgQuery['technologyId'] = $query['technologyId'];
        }

        return $orgQuery;
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return mixed
     */
    public function addTechnologyCount(\Enlight_Event_EventArgs $args)
    {
        $counts = $args->getReturn();
        /** @var QueryBuilder $dbalQueryBuilder */
        $dbalQueryBuilder = Shopware()->Container()->get('dbal_connection')->createQueryBuilder();
        $technologyCount = $dbalQueryBuilder->select('COUNT(technologies.id)')
            ->from('technology_plugin', 'technologies')
            ->execute()
            ->fetchAll(\PDO::FETCH_COLUMN);

        $counts['technologies'] = $technologyCount;

        return $counts;
    }

}
