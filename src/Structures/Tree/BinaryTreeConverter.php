<?php
/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */

namespace adrianschubek\Structures\Tree;


use adrianschubek\Structures\Linear\DynamicList;

class BinaryTreeConverter
{
    private BinaryTree $tree;

    public function __construct(BinaryTree $tree)
    {
        $this->tree = $tree;
    }

    public static function fromList(DynamicList $list): BinaryTree
    {

    }

    public static function fromString(string $string): BinaryTree
    {

    }

    public static function fromBinaryTree(): BinaryTree
    {

    }

    public static function fromXml(string $xml): BinaryTree
    {

    }

    public static function unpack(string $tree): BinaryTree
    {
        return unserialize($tree);
    }

    public static function fromJson(string $json): BinaryTree
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