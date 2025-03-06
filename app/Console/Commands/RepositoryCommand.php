<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepositoryCommand extends FileFactoryCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {classname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command creates a new repository pattern';

    function setStubName(): string
    {
        return "repositorypattern";
    }
    function setStubPath(): string
    {
        return "App\\Repositories\\";
    }
    function setSuffix(): string
    {
        return "Repository";
    }
}
