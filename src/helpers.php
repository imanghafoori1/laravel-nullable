<?php

use Imanghafoori\Helpers\Nullable;

function nullable($nullable, $predicate = null)
{
    return new Nullable($nullable, $predicate);
}
