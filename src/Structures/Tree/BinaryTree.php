<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


class BinaryTree
{
    private ?BinaryTreeNode $node = null;

    public function __construct($object = null, BinaryTree $left = null, BinaryTree $right = null)
    {
        $this->node = new BinaryTreeNode($object);
        if ($left !== null) {
            $this->node->setLeftTree($left);
        } else {
            $this->node->setLeftTree(new BinaryTree());
        }
        if ($right !== null) {
            $this->node->setRightTree($right);
        } else {
            $this->node->setRightTree(new BinaryTree());
        }
    }

    public function setContent($object)
    {
        if ($object === null) return;

        if ($this->isEmpty()) {
            $this->node = new BinaryTreeNode($object);
            $this->node->setLeftTree(new BinaryTree());
            $this->node->setRightTree(new BinaryTree());
        }
        $this->node->setContent($object);
    }

    public function isEmpty(): bool
    {
        return $this->node === null;
    }

    public function getContent()
    {
        return $this->node->getContent();
    }

    public function setLeftTree(BinaryTree $tree)
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setLeftTree($tree);
        }
    }

    public function setRightTree(BinaryTree $tree)
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setRightTree($tree);
        }
    }

    public function getLeftTree(): BinaryTree
    {
        return $this->node->getLeftTree();
    }

    public function getRightTree(): BinaryTree
    {
        return $this->node->getRightTree();
    }
}