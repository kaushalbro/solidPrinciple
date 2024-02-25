<?php

function path($name): string
{
     if ($name == 'contoller'){
        return 'app/Http/Controllers';
     }
    if ($name == 'model'){
        return 'app/Models';
    }
    if ($name == 'request'){
        return 'app/Http/Requests';
    }
    if ($name == 'repo'){
        return 'app/Repositories';
    }
    return base_path();
}
