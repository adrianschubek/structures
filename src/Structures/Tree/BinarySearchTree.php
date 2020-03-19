<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


class BinarySearchTree
{
    private ?BinarySearchTreeNode $node = null;

    public function __construct($object = null, BinarySearchTree $left = null, BinarySearchTree $right = null)
    {
        $this->node = new BinarySearchTreeNode($object);
        if ($left !== null) {
            $this->node->setLeftTree($left);
        } else {
            $this->node->setLeftTree(new BinarySearchTree());
        }
        if ($right !== null) {
            $this->node->setRightTree($right);
        } else {
            $this->node->setRightTree(new BinarySearchTree());
        }
    }

    public function setContent($object)
    {
        if ($object === null) return;

        if ($this->isEmpty()) {
            $this->node = new BinarySearchTreeNode($object);
            $this->node->setLeftTree(new BinarySearchTree());
            $this->node->setRightTree(new BinarySearchTree());
        }
        $this->node->setContent($object);
    }

    public function isEmpty(): bool
    {
        return $this->node === null;
    }

    public function insert(Comparable $object)
    {
        if ($object === null) return;

        if ($this->isEmpty()) {
            $this->node = new BinarySearchTreeNode($object);
        } else {
            $i = $this->getContent()->compareTo($object);
            if ($i < 0) {
                $this->node->getLeftTree()->insert($object);
            } elseif ($i > 0) {
                $this->node->getRightTree()->insert($object);
            }
        }
    }

    public function getContent(): Comparable
    {
        return $this->node->getContent();
    }

    public function remove(Comparable $object)
    {
        if ($this->isEmpty() || $object === null) return;

        $x = $object->compareTo($this->node->getContent());
        if ($x < 0) {
            $this->node->getLeftTree()->remove($object);
        } elseif ($x > 0) {
            $this->node->getRightTree()->remove($object);
        } else {
            if ($this->node->getLeftTree()->isEmpty()) {
                if ($this->node->getRightTree()->isEmpty()) {
                    $this->node = null;
                } else {
                    $this->node = $this->getNextRightNode();
                }
            } elseif ($this->node->getRightTree()->isEmpty()) {
                $this->node = $this->getNextLeftNode();
            } else {
                if ($this->getNextRightNode()->getLeftTree()->isEmpty()) {
                    $this->node->setContent($this->getNextRightNode()->getContent());
                    $this->node->setRightTree($this->getNextRightNode()->getRightTree());
                } else {
                    $prev = $this->getRightTree()->getLastTreeWithNoLeftTree();
                    $smallest = $prev->node->getLeftTree();
                    $this->node->setContent($smallest->getContent());
                    $prev->remove($smallest->node->getContent());
                }
            }
        }
    }

    private function getNextRightNode(): BinarySearchTreeNode
    {
        return $this->node->getRightTree()->node;
    }

    private function getNextLeftNode(): BinarySearchTreeNode
    {
        return $this->node->getLeftTree()->node;
    }

    private function getLastTreeWithNoLeftTree(): BinarySearchTree
    {
        if ($this->getNextLeftNode()->getLeftTree()->isEmpty()) return $this;

        return $this->node->getLeftTree()->getLastTreeWithNoLeftTree();
    }

    public function getRightTree(): BinarySearchTree
    {
        return $this->node->getRightTree();
    }

    public function search(Comparable $object): Comparable
    {
        if ($this->isEmpty() || $object === null) return null;

        $x = $this->getContent()->compareTo($object);
        if ($x < 0) {
            return $this->getLeftTree()->search($object);
        } elseif ($x > 0) {
            return $this->getRightTree()->search($object);
        }
        return $object;
    }

    public function getLeftTree(): BinarySearchTree
    {
        return $this->node->getLeftTree();
    }

    public function setLeftTree(BinarySearchTree $tree)
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setLeftTree($tree);
        }
    }

    public function setRightTree(BinarySearchTree $tree)
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setRightTree($tree);
        }
    }
}