<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class StackNode
{
    private $object = null;
    private ?StackNode $next = null;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function getNext(): StackNode
    {
        return $this->next;
    }

    public function setNext(StackNode $next)
    {
        $this->next = $next;
    }

    public function getContent()
    {
        return $this->object;
    }
}