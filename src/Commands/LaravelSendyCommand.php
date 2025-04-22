<?php

namespace Coderflex\LaravelSendy\Commands;

use Illuminate\Console\Command;

class LaravelSendyCommand extends Command
{
    public $signature = 'laravel-sendy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
