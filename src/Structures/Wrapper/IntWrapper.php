<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Wrapper;


use adrianschubek\Support\Comparable;

class IntWrapper implements Wrapper, Comparable
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function set(int $value): void
    {
        $this->value = $value;
    }

    public function compareTo(Comparable $object): int
    {
        return $this->value <=> $object->unpack();
    }

    public function unpack(): int
    {
        return $this->value;
    }
}