<?php

namespace EolabsIo\ShopifyRestAdminApi;

class Shopify
{

    /**
     * Indicates if Shopify migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = false;


    /**
     * Configure Shopify to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Configure Shopify to register its migrations.
     *
     * @return static
     */
    public static function shouldRunMigrations()
    {
        static::$runsMigrations = true;

        return new static;
    }
}
