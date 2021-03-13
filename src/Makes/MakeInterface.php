<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeInterface extends GeneratorCommand
{
  protected $name = 'make:interface';

  protected $type = 'Interface';

	protected $description = 'Creates a new interface';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/Stubs/make-interface.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Interfaces';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the interface.'],
    ];
  }
}
