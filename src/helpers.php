<?php

use Imanghafoori\Helpers\Nullable;

function nullable($nullable, $message = [], $predicate = null)
{
    return new Nullable($nullable, (array)$message, $predicate);
}
