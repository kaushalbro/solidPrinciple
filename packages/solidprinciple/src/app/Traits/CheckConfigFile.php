<?php

namespace Devil\Solidprinciple\app\Traits;

trait CheckConfigFile
{
    public function checkConfig()
    {
            if (!config('solid')) {
                 error_log(sprintf("\033[31m%s\033[0m", "solid.php Configuration file is required. \nCommand to generate Config file: php artisan solid:make --config"));
                return exit();
            }

    }

}
