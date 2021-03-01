<?php

namespace TM\Commands\Makes;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeContract extends GeneratorCommand
{
  protected $name = 'make:contract';

  protected $type = 'Contract';

	protected $description = 'Creates a new contract';

  /**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
  protected function getStub() : string
  {
    return __DIR__ . '/stubs/make-contract.stub';
  }

  /**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Contracts';
	}

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the contract.'],
    ];
  }
}
