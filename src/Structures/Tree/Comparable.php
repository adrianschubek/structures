<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


interface Comparable
{
    /**
     * @param Comparable $object
     * @return int -1, 0 or 1
     */
    public function compareTo(Comparable $object): int;
}