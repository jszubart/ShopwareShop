<?php


/**
 * Class Technologies controller
 */
class Shopware_Controllers_Frontend_Technologies extends Enlight_Controller_Action
{

    public function indexAction()
    {
        /** @var \Doctrine\DBAL\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $this->container->get('dbal_connection')->createQueryBuilder();

        $technologies = $queryBuilder->select('technologies.name, technologies.url, technologies.logo, image.path as logo')
            ->from('virtua_technology', 'technologies')
            ->leftJoin('technologies', 's_media', 'image','technologies.logo = image.id')
            ->execute()
            ->fetchAll();

        $this->View()->assign('technologies', $technologies);
    }

    public function detailAction()
    {
        $technologyId = $this->Request()->getParam('id');

        /** @var \Doctrine\DBAL\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $this->container->get('dbal_connection')->createQueryBuilder();

        $technology = $queryBuilder->select('technologies.id, technologies.url, technologies.description, technologies.logo, image.path as logo')
            ->from('virtua_technology', 'technologies')
            ->leftJoin('technologies', 's_media', 'image','technologies.logo = image.id')
            ->where('technologies.id = :id')
            ->setParameter(':id', $technologyId)
            ->execute()
            ->fetch();

        $this->View()->assign($technology);
    }
}