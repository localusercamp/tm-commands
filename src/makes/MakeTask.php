<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeTask extends GeneratorCommand
{
  protected $name = 'make:task';

  protected $type = 'Task';

	protected $description = 'Creates a new task';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/stubs/make-task.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Tasks';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the task.'],
    ];
  }
}
