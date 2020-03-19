<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class Queue
{
    private ?QueueNode $first = null;
    private ?QueueNode $last = null;

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
        $list = clone $this;
        $arr = [];
        $list->forEach(function ($el) use (&$arr) {
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
        if ($this->isEmpty()) {
            $this->first = null;
            $this->last = null;
        }
    }
}