<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Wrapper;




use adrianschubek\Support\Comparable;

class FloatWrapper implements Wrapper, Comparable
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function unpack(): float
    {
        return $this->value;
    }

    public function set(float $value): void
    {
        $this->value = $value;
    }
    public function compareTo(Comparable $object): int
    {
        return $this->value <=> $object->unpack();
    }
}