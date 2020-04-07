<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class Queue implements LinearTraversable
{
    private ?QueueNode $first = null;
    private ?QueueNode $last = null;

    public function __construct($objects = [])
    {
        foreach ((array)$objects as $object) {
            $this->enqueue($object);
        }
    }

    public function enqueue($content)
    {
        if ($content === null) return;

        $new = new QueueNode($content);
        if ($this->isEmpty()) {
            $this->first = $new;
            $this->last = $new;
        } else {
            $this->last->setNext($new);
            $this->last = $new;
        }
    }

    public function isEmpty(): bool
    {
        return $this->first === null;
    }

    public function toArray(): array
    {
        $arr = [];
        $this->forEach(function ($el) use (&$arr) {
            $arr[] = $el;
        });
        return $arr;
    }

    public function forEach(callable $callback)
    {
        $queue = clone $this;
        while (!$queue->isEmpty()) {
            $callback($queue->first());
            $queue->dequeue();
        }
    }

    public function first()
    {
        return $this->first->getContent();
    }

    public function dequeue()
    {
        if ($this->isEmpty()) return;

        $this->first = $this->first->getNext();
    }
}