<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;

use adrianschubek\Support\Comparable;

class BinarySearchTreeNode
{
    private ?Comparable $object = null;
    private BinarySearchTree $left, $right;

    public function __construct($object)
    {
        $this->object = $object;
        $this->left = new BinarySearchTree();
        $this->right = new BinarySearchTree();
    }

    public function getRightTree(): BinarySearchTree
    {
        return $this->right;
    }

    public function setRightTree(BinarySearchTree $right): void
    {
        $this->right = $right;
    }

    public function getLeftTree(): BinarySearchTree
    {
        return $this->left;
    }

    public function setLeftTree(BinarySearchTree $left): void
    {
        $this->left = $left;
    }

    public function getContent(): Comparable
    {
        return $this->object;
    }

    public function setContent(Comparable $object): void
    {
        $this->object = $object;
    }
}