<?php

use Imanghafoori\Helpers\Nullable;

function nullable($nullable = null, $message = [], $predicate = null)
{
    return new Nullable($nullable, (array)$message, $predicate);
}
