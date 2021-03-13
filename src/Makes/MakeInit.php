<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeInit extends GeneratorCommand
{
  protected $name = 'make:init';

	protected $description = 'Generates initial namespaces, folders, classes and interfaces.';

	protected $init_stubs_folder = __DIR__ . DIRECTORY_SEPARATOR . 'Stubs' . DIRECTORY_SEPARATOR . 'Init';

	protected $namespaces = [
    'Contracts'  => 'App\\Contracts',
    'Interfaces' => 'App\\Interfaces',
  ];

  protected function getStub() {}

  protected function getArguments()
  {
    return [];
  }

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $directories = $this->files->directories($this->init_stubs_folder);
    foreach ($directories as $directory) {
      $stubs     = $this->files->files($directory);
      $dirname   = $this->files->name($directory);
      $namespace = $this->namespaces[$dirname];
      foreach ($stubs as $stub) {
        $stub_path_name = $stub->getPathname();
        $stub_name      = $this->files->name($stub_path_name);
        $namespace_name = "$namespace\\$stub_name";
        $class_name     = $this->qualifyClass($namespace_name);
        $path = $this->getPath($class_name);

        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($namespace_name)) {
            $this->error("$namespace_name already exists!");

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($stub_path_name)));

        $this->info("$class_name generated successfully.");
      }
    }
  }

  /**
   * Build the class.
   */
  protected function buildClass($path)
  {
    $stub = $this->files->get($path);

    return $stub;
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [
      new InputOption('force', null, InputOption::VALUE_NONE, 'Regenerate'),
    ];
  }
}
