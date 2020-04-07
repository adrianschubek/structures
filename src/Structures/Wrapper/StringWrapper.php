<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Wrapper;


use adrianschubek\Structures\Tree\Comparable;

class StringWrapper implements Wrapper, Comparable
{
    private string $value;

    public function __construct(string $str)
    {
        $this->value = $str;
    }

    public function set(string $str): void
    {
        $this->value = $str;
    }

    public function compareTo(Comparable $object): int
    {
        return $this->value <=> $object->unpack();
    }

    public function unpack(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->unpack();
    }
}