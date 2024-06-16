<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDTO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:DTO {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create DTO Class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $directory = app_path("/DTO/$name.php");
        if(file_exists($directory)){
            $this->error("This DTO already exists");
            return;
        }
        $content = 
        <<<php
        <?php
        namespace App\DTO;
        Class $name
        {
            public function __construct()
            {
            }
        }
        ?>
        php;
        file_put_contents($directory, $content);
        $this->info("DTO created successfully");
        return;
    }
}
