<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class ListNode
{
    private $object = null;
    private ?ListNode $next = null;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function getContent()
    {
        return $this->object;
    }

    public function setContent($object)
    {
        $this->object = $object;
    }

    public function getNextNode(): ?ListNode
    {
        return $this->next;
    }

    public function setNextNode(ListNode $node)
    {
        $this->next = $node;
    }
}