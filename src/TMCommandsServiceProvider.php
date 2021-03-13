<?php

namespace TM\Commands;

use Illuminate\Support\ServiceProvider;
use TM\Commands\Makes\MakeContract;
use TM\Commands\Makes\MakeAction;
use TM\Commands\Makes\MakeTask;
use TM\Commands\Makes\MakeEntity;
use TM\Commands\Makes\MakeCollection;
use TM\Commands\Makes\MakeBuilder;
use TM\Commands\Makes\MakeInterface;
use TM\Commands\Makes\MakeInit;

class TMCommandsServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {

  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    if ($this->app->runningInConsole()) {
      $this->commands([
        MakeContract::class,
        MakeAction::class,
        MakeTask::class,
        MakeEntity::class,
        MakeCollection::class,
        MakeInterface::class,
        MakeInit::class,
        MakeBuilder::class,
      ]);
    }
  }
}
