<?php

namespace HossamTarek\LaravelPresenter\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakePresenterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:presenter {className}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Presenter class';

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
     * @return int
     */
    public function handle()
    {
        $className = $this->argument('className');

        $this->createDirectory($className);

        $filesystem = new Filesystem();
        $stubContent = $filesystem->get(__DIR__ . '/../Stubs/Presenter.php.stub');

        $customizedStub = str_replace([
            '{{namespace}}',
            '{{className}}',
            '{{classContent}}',
        ], [
            $this->getNamespace($className),
            $this->getClassName($className),
            '',
        ], $stubContent);

        $filesystem->put(app_path('Presenters/'.$className.'.php'), $customizedStub);

        $this->info('File generated successfully!');
        return 0;
    }

    private function createDirectory($className)
    {
        $directory = app_path('Presenters/'.dirname($className));
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function getNamespace($className)
    {
        preg_match('/^(.*?)(?=\/[^\/]+$)/', $className, $nameSpaceMatching);
        return 'App\Presenters'.(isset($nameSpaceMatching[0]) ? '\\'.str_replace('/', '\\', $nameSpaceMatching[0]) : '');
    }

    private function getClassName($className)
    {
        preg_match('/(?=.*?)([^\/]+)$/', $className, $classNameMatching);
        return $classNameMatching[0];
    }

}