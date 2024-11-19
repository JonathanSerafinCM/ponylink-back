<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * This value is used by Laravel to generate URLs to actions such as
     * the `index` method of a controller. The value of this property should
     * be the same as the "namespace" configuration value found in the
     * `config/app.php` file.
     *
     * @var string|null
     */
    protected $namespace = null; // Esto debería estar así o completamente eliminado
}
