<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBuilder extends GeneratorCommand
{
  protected $name = 'make:builder';

  protected $type = 'Builder';

	protected $description = 'Creates a new builder';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/Stubs/make-builder.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Builders';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the builder.'],
    ];
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [
      new InputOption('model', 'm', InputOption::VALUE_REQUIRED, 'The name of the model to bind to'),
    ];
  }

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $models_namespace = 'App\\Models';

    $model  = $this->option('model');
    $name   = $this->argument('name');
    $class  = "{$models_namespace}\\{$model}";
    $exists = class_exists($class);

    if ($exists) {
      $ds = DIRECTORY_SEPARATOR;
      $file_path = app_path("Models{$ds}{$model}.php");

      $new_eloquent_builder_exists = strpos(file_get_contents($file_path), 'function newEloquentBuilder(') !== false;

      if ($new_eloquent_builder_exists) {
        $this->warn(' The newEloquentBuilder method already exists.');
      }
      else {
        $search  = '}';
        $stub    = file_get_contents(__DIR__ . "{$ds}Stubs{$ds}builder-model-bind.stub");
        $insert  = str_replace(['{{ class }}', '{{class}}'], $name, $stub);
        $replace = "\n{$insert}\n{$search}";
        file_put_contents($file_path, Str::replaceLast($search, $replace, file_get_contents($file_path)));

        $search    = "namespace {$models_namespace};";
        $namespace = $this->getDefaultNamespace(trim($this->rootNamespace(), '\\'));
        $insert    = "use $namespace\\$name;";
        $replace   = "{$search}\n\n{$insert}";
        file_put_contents($file_path, Str::replaceLast($search, $replace, file_get_contents($file_path)));
      }
    }
    else {
      $this->error(" model $model not found!");
    }
    return parent::handle();
  }
}
