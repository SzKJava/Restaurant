<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateServiceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new service';

    protected function getStub() {

        return base_path( "stubs/service.stub" );
    }

    protected function getDefaultNamespace( $rootNameSpace ) {

        return $rootNameSpace . "\Services";
    }

   
}
