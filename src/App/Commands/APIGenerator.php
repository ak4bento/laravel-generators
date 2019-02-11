<?php

namespace Akill\Generators\App\Commands;

use Illuminate\Console\Command;
use File;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class APIGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'akill:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create controller, repositories, resource, service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->route($name);
        $this->controller($name);
        $this->repository($name);
        $this->resource($name);
        $this->service($name);
        $this->helper($name);
        $this->model($name);
    }

    /**
     * Get content template stub.
     *
     * @return file stub
     */
    protected function getStub($type){
        return file_get_contents(__DIR__."/../Resources/stubs/$type.stub");
    }

    /**
     * Append route to route file.
     *
     * @return file stub
     */
    protected function route($name){
        $routeTemplate = str_replace(
            ['{{modelName}}','{{modelNamePlural}}'],
            [$name, strtolower(str_plural($name))],
            $this->getStub('Routes')
        );
        File::append(base_path('routes/api.php'),$routeTemplate);
    }

    /**
     * Add controlller to directory.
     *
     * @return file stub
     */
    protected function controller($name){
        if (!file_exists(app_path("Http/Controllers/Api/"))) {
            mkdir(app_path("Http/Controllers/Api/"), 0777, true);
        }
        $controllerTemplate = str_replace([
           '{{modelName}}',
           '{{modelNamePlural}}',
           '{{modelNameSingular}}'
        ],
        [
           $name,
           strtolower(str_plural($name)),
           strtolower($name)
        ],
        $this->getStub('Controller'));
        file_put_contents(app_path("Http/Controllers/Api/{$name}Controller.php"), $controllerTemplate);
    }

    /**
     * Add repository to directory.
     *
     * @return file stub
     */
    protected function repository($name){
        if (!file_exists(app_path("Http/Repositories"))) {
            mkdir(app_path("Http/Repositories"), 0777, true);
        }
        $repositoryTemplate = str_replace([
           '{{modelName}}',
           '{{modelNamePlural}}',
           '{{modelNameSingular}}'
        ],
        [
           $name,
           strtolower(str_plural($name)),
           strtolower($name)
        ],
        $this->getStub('Repository'));
        file_put_contents(app_path("Http/Repositories/{$name}Repository.php"), $repositoryTemplate);
    }

    /**
     * Add resource to directory.
     *
     * @return file stub
     */
    protected function resource($name){
        if (!file_exists(app_path("Http/Resources"))) {
            mkdir(app_path("Http/Resources"), 0777, true);
        }
        $resourceTemplate = str_replace([
           '{{modelName}}',
           '{{modelNamePlural}}',
           '{{modelNameSingular}}'
        ],
        [
           $name,
           strtolower(str_plural($name)),
           strtolower($name)
        ],
        $this->getStub('Resource'));
        file_put_contents(app_path("Http/Resources/{$name}Resource.php"), $resourceTemplate);
    }

    /**
     * Add service to directory.
     *
     * @return file stub
     */
    protected function service($name){
        if (!file_exists(app_path("Http/Services"))) {
            mkdir(app_path("Http/Services"), 0777, true);
        }
        $serviceTemplate = str_replace([
           '{{modelName}}',
           '{{modelNamePlural}}',
           '{{modelNameSingular}}'
        ],
        [
           $name,
           strtolower(str_plural($name)),
           strtolower($name)
        ],
        $this->getStub('Service'));
        file_put_contents(app_path("Http/Services/{$name}Service.php"), $serviceTemplate);
    }

    /**
     * Add Helper to directory.
     *
     * @return file stub
     */
    protected function helper($name){
        if (!file_exists(app_path("Http/Helpers"))) {
            mkdir(app_path("Http/Helpers"), 0777, true);
        }
        $helperTemplate = str_replace([
           '{{modelName}}',
           '{{modelNamePlural}}',
           '{{modelNameSingular}}'
        ],
        [
           $name,
           strtolower(str_plural($name)),
           strtolower($name)
        ],
        $this->getStub('Helper'));
        file_put_contents(app_path("Http/Helpers/{$name}Helper.php"), $helperTemplate);
    }

    /**
     * Add model to directory.
     *
     * @return file stub
     */
    protected function model($name){
        if (!file_exists(app_path("Http/Models"))) {
            mkdir(app_path("Http/Models"), 0777, true);
        }
        $modelTemplate = str_replace(
           ['{{modelName}}', '{{modelNamePlural}}'],
           [$name, strtolower(str_plural($name))],
           $this->getStub('Model')
        );
        file_put_contents(app_path("Http/Models/{$name}.php"), $modelTemplate);
    }
}
