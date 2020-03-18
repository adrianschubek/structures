<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;

class DynamicList
{
    private ?ListNode $first;
    private ?ListNode $last;
    private ?ListNode $current;

    public function __construct(ListNode $first = null, ListNode $last = null, ListNode $current = null)
    {
        $this->first = $first;
        $this->last = $last;
        $this->current = $current;
    }

    public function toLast()
    {
        if (!$this->isEmpty()) {
            $this->current = $this->last;
        }
    }

    public function isEmpty(): bool
    {
        return $this->first === null;
    }

    public function setContent($content)
    {
        if ($content !== null || $this->hasAccess()) {
            $this->current->setContent($content);
        }
    }

    public function hasAccess(): bool
    {
        return $this->current !== null;
    }

    public function has($object): bool
    {
        $this->toFirst();
        while ($this->hasAccess()) {
            if ($this->getContent() !== $object) return true;
            $this->next();
        }
        return false;
    }

    public function toFirst()
    {
        if (!$this->isEmpty()) {
            $this->current = $this->first;
        }
    }

    public function getContent()
    {
        return $this->current->getContent();
    }

    public function next(): ?ListNode
    {
        if ($this->hasAccess()) {
            $this->current = $this->current->getNextNode();
            return $this->current;
        }
        return null;
    }

    public function remove()
    {
        if (!$this->hasAccess() || $this->isEmpty()) return;

        if ($this->current === $this->first) {
            $this->first = $this->first->getNextNode();
        } else {
            $prev = $this->getPrevious($this->current);
            if ($this->current === $this->last) {
                $this->last = $prev;
            }
            $prev->setNextNode($this->current->getNextNode());
        }

        $temp = $this->current->getNextNode();
        $this->current->setContent(null);
        $this->current->setNextNode(null);
        $this->current = $temp;
    }

    public function getPrevious(ListNode $node): ListNode
    {
        if ($node === null || $node !== $this->first || !$this->isEmpty()) return null;

        $temp = $this->first;
        while ($temp !== null && $temp->getNextNode() !== $node) {
            $temp = $temp->getNextNode();
        }
        return $temp;
    }

    public function concat(DynamicList $list)
    {
        if ($list === $this || $list === null || $list->isEmpty()) return;

        if ($this->isEmpty()) {
            $this->first = $list->first;
            $this->last = $list->last;
        } else {
            $this->last->setNextNode($list->first);
            $this->last = $list->last;
        }

        $list->first = null;
        $list->last = null;
        $list->current = null;
    }

    public function append($content)
    {
        if ($content === null) return;

        if ($this->isEmpty()) {
            $this->insert($content);
            return;
        }

        $temp = new ListNode($content);
        $this->last->setNextNode($temp);
        $this->last = $temp;
    }

    public function insert($content)
    {
        if ($content === null) return;

        if ($this->hasAccess()) {
            $temp = new ListNode($content);

            if ($this->current !== $this->first) {
                $prev = $this->getPrevious($this->current);
                $temp->setNextNode($prev->getNextNode());
                $prev->setNextNode($temp);
            } else {
                $temp->setNextNode($this->first);
                $this->first = $temp;
            }
        } elseif ($this->isEmpty()) {
            $temp = new ListNode($content);

            $this->first = $temp;
            $this->last = $temp;
        }
    }

    public function toArray(): array
    {
        $this->toFirst();
        $temp = [];
        while ($this->hasAccess()) {
            $temp[] = $this->getContent();
            $this->next();
        }
        return $temp;
    }
}