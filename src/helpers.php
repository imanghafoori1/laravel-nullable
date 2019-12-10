<?php

use Imanghafoori\Helpers\Nullable;

/**
 * pass object of Nullable
 *
 * @param null  $nullable
 * @param array $message
 * @param null  $predicate
 *
 * @return Nullable
 */
function nullable($nullable = null, $message = [], $predicate = null)
{
    return new Nullable($nullable, (array)$message, $predicate);
}
