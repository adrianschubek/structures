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
        if ($object === null) {
            return;
        }
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

    public function setLeftAndRightTree(BinaryTree $left, BinaryTree $right): self
    {
        if (!$this->isEmpty() && $left !== null && $right !== null) {
            $this->node->setLeftTree($left);
            $this->node->setRightTree($right);
        }

        return $this;
    }

    public function setLeftTree(BinaryTree $tree): self
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setLeftTree($tree);
        }
        return $this;
    }

    public function setRightTree(BinaryTree $tree): self
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setRightTree($tree);
        }
        return $this;
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