<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


interface LinearTraversable
{
    public function forEach(callable $callback);

    public function toArray(): array;
}