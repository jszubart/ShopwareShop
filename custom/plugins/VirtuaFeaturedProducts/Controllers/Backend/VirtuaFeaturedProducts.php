<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */
class Shopware_Controllers_Backend_VirtuaFeaturedProducts extends Shopware_Controllers_Backend_Application
{
    protected $model = \VirtuaFeaturedProducts\Models\FeaturedProducts::class;

    protected $alias = 'featured_products';
}
