<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeEntity extends GeneratorCommand
{
  protected $name = 'make:entity';

  protected $type = 'Entity';

	protected $description = 'Creates a new entity';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/stubs/make-entity.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Entities';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the entity.'],
    ];
  }
}
