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

class BinarySearchTreeConverter
{
    private BinarySearchTree $tree;

    public function __construct(BinarySearchTree $tree)
    {
        $this->tree = $tree;
    }

    public static function fromList(DynamicList $list): BinarySearchTree
    {
        $bst = new BinarySearchTree();
        $list->forEach(fn($el) => $bst->insert(self::wrapIfNeeded($el)));
        return $bst;
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

    public static function fromArray(array $arr): BinarySearchTree
    {
        $bst = new BinarySearchTree();
        foreach ($arr as $x) {
            $bst->insert(self::wrapIfNeeded($x));
        }
        return $bst;
    }

    public static function fromString(string $string): BinarySearchTree
    {

    }

    public static function fromBinarySearchTree(): BinarySearchTree
    {

    }

    public static function fromXml(string $xml): BinarySearchTree
    {

    }

    public static function unpack(string $tree): BinarySearchTree
    {
        return unserialize($tree);
    }

    public static function fromJson(string $json): BinarySearchTree
    {

    }

    public function pack(): string
    {
        return serialize($this->tree);
    }

    public function toXml(): string
    {

    }

    public function toList(): DynamicList
    {

    }

    public function toJson(): string
    {

    }
}