<?php
namespace Akill\Generators;

/**
 * @author Muhammad Akil <muhammad@akil.co.id>
 *
 */
use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function registerCommmandGenerator()
    {

    }
}
