<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Linear;


class QueueNode
{
    private $content = null;
    private ?QueueNode $next = null;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getNext(): ?QueueNode
    {
        return $this->next;
    }

    public function setNext(?QueueNode $node)
    {
        $this->next = $node;
    }

    public function getContent()
    {
        return $this->content;
    }
}