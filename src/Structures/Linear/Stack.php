<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class Stack implements LinearTraversable
{
    private ?StackNode $head = null;

    public function push($object)
    {
        if ($object === null) return;

        $node = new StackNode($object);
        $node->setNext($this->head);
        $this->head = $node;
    }

    public function toArray(): array
    {
        $stack = clone $this;
        $arr = [];
        $stack->forEach(function ($el) use (&$arr) {
            $arr[] = $el;
        });
        return $arr;
    }

    public function forEach(callable $callback)
    {
        $stack = clone $this;
        while (!$stack->isEmpty()) {
            $callback($stack->pop());
        }
    }

    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    public function pop()
    {
        if (!$this->isEmpty()) {
            $obj = $this->getContent();
            $this->head = $this->head->getNext();
            return $obj;
        }
        return null;
    }

    public function getContent()
    {
        return $this->head->getContent();
    }
}