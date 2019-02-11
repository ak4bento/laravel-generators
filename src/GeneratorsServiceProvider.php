<?php
namespace Akill\Generators;

/**
 * @author Muhammad Akil <muhammad@akil.co.id>
 *
 */
use Illuminate\Support\ServiceProvider;
use Akill\Generators\App\Commands\APIGenerator;

class GeneratorsServiceProvider extends ServiceProvider
{
    private $commandPath = 'command.akill.';

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
        $this->registerCommmandGenerator(APIGenerator::class, 'publish');
    }

    private function registerCommmandGenerator($class, $command)
    {
        $this->app->singleton($this->commandPath . $command, function ($app) use ($class) {
            return $app[$class];
        });
        $this->commands($this->commandPath . $command);
    }
}
