<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class Deque implements LinearTraversable
{
    private ?QueueNode $first = null;
    private ?QueueNode $last = null;

    public function __construct($objects = [])
    {
        foreach ((array)$objects as $object) {
            $this->push($object);
        }
    }

    public function push($content)
    {
        if ($content === null) return;
        $new = new QueueNode($content);

        if ($this->isEmpty()) {
            $this->first = $new;
            $this->last = $new;
            return;
        }

        $this->last->setNext($new);
        $this->last = $new;
    }

    public function isEmpty(): bool
    {
        return $this->first === null;
    }

    public function unshift($content)
    {
        if ($content === null) return;
        $new = new QueueNode($content);

        if ($this->isEmpty()) {
            $this->first = $new;
            $this->last = $new;
            return;
        }

        $temp = $this->first;
        $this->first = $new;
        $this->first->setNext($temp);
    }

    public function diff(DynamicList $list): array
    {
        if ($list === $this) return [];

        return array_diff($this->toArray(), $list->toArray());
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
        $deque = clone $this;
        $current = $this->first;
        while ($current !== null) {
            $callback($deque->shift()->getContent());
            $current = $current->getNext();
        }
    }

    public function shift()
    {
        if ($this->isEmpty()) {
            return null;
        }

        $current = $this->first;
        if ($current->getNext() !== null) {
            $this->first = $current->getNext();
        }
        return $current;
    }

    public function pop()
    {
        if ($this->isEmpty()) {
            return null;
        }

        $current = $this->first;
        while ($current !== null) {
            if ($current->getNext() === $this->last) {
                $this->last = $current;
                $current->setNext(null);
                return $current;
            }
            $current = $current->getNext();
        }
        return null;
    }

    public function first()
    {
        return $this->first->getContent();
    }

    public function last()
    {
        return $this->last->getContent();
    }
}