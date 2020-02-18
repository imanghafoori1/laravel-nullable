<?php

use Imanghafoori\Helpers\Nullable;

/**
 * pass object of Nullable.
 *
 * @param mixed        $nullable
 * @param array        $message
 * @param null|Closure $predicate
 *
 * @return Nullable
 */
function nullable($nullable = null, $message = [], $predicate = null)
{
    return new Nullable($nullable, (array) $message, $predicate);
}
