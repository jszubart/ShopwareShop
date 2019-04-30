<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */
class Shopware_Controllers_Backend_VirtuaTechnology extends Shopware_Controllers_Backend_Application
{
    protected $model = \VirtuaTechnology\Models\Technology::class;

    protected $alias = 'technology';
}
