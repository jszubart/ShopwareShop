<?php

namespace VirtuaTechnology;

use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Doctrine\ORM\Tools\SchemaTool;
use VirtuaTechnology\Models\Technology;

/**
 * Shopware-Plugin VirtuaTechnology.
 */
class VirtuaTechnology extends Plugin
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
            ->from('virtua_technology', 'technology')
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
            ->from('virtua_technology', 'technologies')
            ->execute()
            ->fetchAll(\PDO::FETCH_COLUMN);

        $counts['technologies'] = $technologyCount;

        return $counts;
    }

}
