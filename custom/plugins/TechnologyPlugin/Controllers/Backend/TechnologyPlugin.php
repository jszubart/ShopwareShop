<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */
class Shopware_Controllers_Backend_TechnologyPlugin extends Shopware_Controllers_Backend_Application
{
    protected $model = \TechnologyPlugin\Models\Technology::class;

    protected $alias = 'technology';
}
