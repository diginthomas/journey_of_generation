<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class CommonFieldServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      Blueprint::macro('commonFields', function () {
          $this->foreignId('created_by')->nullable()->constrained('users');
          $this->foreignId('updated_by')->nullable()->constrained('users');
          $this->foreignId('deleted_by')->nullable()->constrained('users');
          $this->timestampsTz();
          $this->softDeletesTz();
      });
    }
}
