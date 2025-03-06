<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

abstract class FileFactoryCommand extends Command
{
    protected $file;
    public function __construct(Filesystem $file)
    {
        Parent::__construct();
        $this->file = $file;
    }

    abstract function setStubName(): string;
    abstract function setStubPath(): string;
    abstract function setSuffix(): string;

    public function singleClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function stubPath()
    {
        $stubName = $this->setStubName();
        return __DIR__ . "/../../../stubs/{$stubName}.stub";
    }

    public function mkdir($path)
    {
        $this->file->makeDirectory($path, 0777, true, true);
        return $path;
    }

    public function stubVariables()
    {
        return [
            'NAME' => $this->singleClassName($this->argument('classname')),
        ];
    }

    public function stubContent($stubPath, $stubVariables)
    {
        $content = file_get_contents($stubPath);
        foreach ($stubVariables as $key => $name) {
            $contents = str_replace('$' . $key, $name, $content);
        }
        return $contents;
    }

    public function getPath()
    {
        $filePath = $this->setStubPath();
        $suffix = $this->setSuffix();
        return base_path($filePath) . $this->singleClassName($this->argument('classname')) . "{$suffix}.php";
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->getPath();
        $this->mkdir(dirname($path));

        if ($this->file->exists($path)) {
            $this->info('This file already exists');
        }

        $content = $this->stubContent($this->stubPath(), $this->stubVariables());
        $this->file->put($path, $content);
        $this->info('This file has been created successfully');
    }
}
