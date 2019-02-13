<?php

namespace Akill\Generators\App\Commands;

use Illuminate\Console\Command;
use File;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RelationGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'akill:relation {relation} {field} {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing';

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
        $relation = $this->argument('relation');
        $field = $this->argument('field');
        $controller = $this->argument('controller');
        $this->relation($relation, $field, $controller);
        $this->info('Success Please Check your class');
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
    protected function relation($relation, $field, $controller){
        $result = null;
        $relationTemplate = str_replace(
            ['{{relation}}','{{field}}', '{{controller}}'],
            [$relation, $field, $controller],
            $this->getStub('Relation')
        );
        $relationIndexTemplate = str_replace(
            ['{{relation}}','{{field}}', '{{controller}}'],
            [$relation, $field, $controller],
            $this->getStub('RelationIndex')
        );
        foreach(file(app_path("Http/Controllers/Api/{$controller}Controller.php")) as $line) {
            $result .= $line;
            if (trim($line) == '//Using Relation') {
                $result .= 'use App\Http\Services\\'.$relation.'Service;';
            }
            if (trim($line) == '//Start Relation') {
                # code...
                $result .= $relationTemplate;
            }
            if (trim($line) == '//Start Relation Index') {
                # code...
                $result .= $relationIndexTemplate;
            }
        }

        File::put(app_path("Http/Controllers/Api/{$controller}Controller.php"), $result);
    }
}
