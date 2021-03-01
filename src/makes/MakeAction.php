<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeAction extends GeneratorCommand
{
  protected $name = 'make:action';

  protected $type = 'Action';

	protected $description = 'Creates a new action';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/stubs/make-action.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Actions';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the action.'],
    ];
  }
}
