<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


class BinaryTreeNode
{
    private $object;
    private BinaryTree $left, $right;

    public function __construct($object)
    {
        $this->object = $object;
        $this->left = new BinaryTree();
        $this->right = new BinaryTree();
    }

    public function getRightTree(): BinaryTree
    {
        return $this->right;
    }

    public function setRightTree(BinaryTree $right): void
    {
        $this->right = $right;
    }

    public function getLeftTree(): BinaryTree
    {
        return $this->left;
    }

    public function setLeftTree(BinaryTree $left): void
    {
        $this->left = $left;
    }

    public function getContent()
    {
        return $this->object;
    }

    public function setContent($object): void
    {
        $this->object = $object;
    }
}