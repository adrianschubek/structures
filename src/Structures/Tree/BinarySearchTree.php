<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


use adrianschubek\Structures\Linear\DynamicList;
use adrianschubek\Structures\Wrapper\FloatWrapper;
use adrianschubek\Structures\Wrapper\IntWrapper;
use adrianschubek\Structures\Wrapper\StringWrapper;
use adrianschubek\Structures\Wrapper\Wrapper;

class BinarySearchTree
{
    private ?BinarySearchTreeNode $node = null;

    public function __construct($object = null, BinarySearchTree $left = null, BinarySearchTree $right = null)
    {
        if ($object === null) {
            return;
        } elseif (is_string($object)) {
            $object = new StringWrapper($object);
        } elseif (is_float($object)) {
            $object = new FloatWrapper($object);
        } elseif (is_int($object)) {
            $object = new IntWrapper($object);
        }
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

    public static function fromList(DynamicList $list): self
    {
        $bst = new static();
        $list->forEach(fn($el) => $bst->insert(self::wrapIfNeeded($el)));
        return $bst;
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

    public function isEmpty(): bool
    {
        return $this->node === null;
    }

    public function getContent(): Comparable
    {
        return $this->node->getContent();
    }

    private static function wrapIfNeeded($object = null)
    {
        if (is_string($object)) {
            $object = new StringWrapper($object);
        } elseif (is_float($object)) {
            $object = new FloatWrapper($object);
        } elseif (is_int($object)) {
            $object = new IntWrapper($object);
        }
        return $object;
    }

    public static function fromBinarySearchTree(): BinarySearchTree
    {

    }

    public static function fromString(string $string, string $delimiter = ","): BinarySearchTree
    {
        return BinarySearchTree::fromArray(explode($delimiter, $string));
    }

    public static function fromArray(array $arr): BinarySearchTree
    {
        $bst = new BinarySearchTree();
        foreach ($arr as $x) {
            $bst->insert(self::wrapIfNeeded($x));
        }
        return $bst;
    }

    private static function unwrapIfNeeded($object = null)
    {
        if ($object instanceof Wrapper) {
            return $object->unpack();
        }
        return $object;
    }

    public function toJson(): string
    {
        return json_encode($this->toMultiArray());
    }

    public function toMultiArray(): array
    {
        $data = [];
        $this->walk(function ($el, $depth) use (&$data) {
            if ($el instanceof Wrapper) {
                $data[$depth][] = $el->unpack();
            } else {
                $data[$depth][] = $el;
            }
        });
        return $data;
    }

    public function walk(callable $callback)
    {
        $this->walkInternal($callback, $this);
    }

    private function walkInternal(callable $callback, BinarySearchTree $tree, int $depth = 0)
    {
        if (!$tree->isEmpty()) {
            $this->walkInternal($callback, $tree->getLeftTree(), $depth + 1);

            $callback($tree->getContent(), $depth);

            $this->walkInternal($callback, $tree->getRightTree(), $depth + 1);
        }
    }

    public function getLeftTree(): BinarySearchTree
    {
        return $this->node->getLeftTree();
    }

    public function getRightTree(): BinarySearchTree
    {
        return $this->node->getRightTree();
    }

    public function toList(): DynamicList
    {
        $list = new DynamicList();
        $this->walk(function ($el) use (&$list) {
            $list->append(self::unwrapIfNeeded($el));
        });
        return $list;
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

    public function search(Comparable $object): ?Comparable
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

    public function same(BinarySearchTree $tree): bool
    {
        return $this->toArray() === $tree->toArray();
    }

    public function toArray(): array
    {
        $data = [];
        $this->walk(function ($el) use (&$data) {
            if ($el instanceof Wrapper) {
                $data[] = $el->unpack();
            } else {
                $data[] = $el;
            }
        });
        return $data;
    }

    public function setLeftAndRightTree(BinarySearchTree $left, BinarySearchTree $right): self
    {
        if (!$this->isEmpty() && $left !== null && $right !== null) {
            $this->node->setLeftTree($left);
            $this->node->setRightTree($right);
        }

        return $this;
    }

    public function setLeftTree(BinarySearchTree $tree): self
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setLeftTree($tree);
        }
        return $tree;
    }

    public function setRightTree(BinarySearchTree $tree): self
    {
        if (!$this->isEmpty() && $tree !== null) {
            $this->node->setRightTree($tree);
        }
        return $tree;
    }
}