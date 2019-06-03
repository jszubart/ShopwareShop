<?php

use Doctrine\DBAL\Connection;
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
            ->from('plugin_technology', 'technologies')
            ->leftJoin('technologies', 's_media', 'image','technologies.logo = image.id')
            ->setMaxResults(20)
            ->execute()
            ->fetchAll();

        $this->View()->assign('technologies', $technologies);
    }

    public function detailAction()
    {
        $technologyId = $this->Request()->getParam('technologyId');

        /** @var \Doctrine\DBAL\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $this->container->get('dbal_connection')->createQueryBuilder();

        $technology = $queryBuilder->select('technologies.id, technologies.name, technologies.description, technologies.logo, image.path as logo')
            ->from('plugin_technology', 'technologies')
            ->leftJoin('technologies', 's_media', 'image','technologies.logo = image.id')
            ->where('technologies.id = :id')
            ->setParameter(':id', $technologyId)
            ->execute()
            ->fetch();

        $this->View()->assign('technology', $technology);
    }

    public function technologiesListAction()
    {
        $numbers = $this->Request()->getParam('numbers');
        if (is_string($numbers)) {
            $numbers = array_filter(explode('|', $numbers));
        }
        $queryBuilder = $this->container->get('dbal_connection')->createQueryBuilder();

        if (!is_array($numbers)) {
            return;
        }

        $technologies = $queryBuilder->select('technologies.id, technologies.name, technologies.url, technologies.description, technologies.logo, image.path as logo')
            ->from('plugin_technology', 'technologies')
            ->leftJoin('technologies', 's_media', 'image','technologies.logo = image.id')
            ->where('technologies.id IN (:ids)')
            ->setParameter(':ids', $numbers, Connection::PARAM_INT_ARRAY)
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        $this->View()->assign('technologies', $technologies);

    }
}