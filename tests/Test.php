<?php

use adrianschubek\Structures\Linear\Deque;
use adrianschubek\Structures\Linear\DynamicList;
use adrianschubek\Structures\Linear\Queue;
use adrianschubek\Structures\Tree\BinarySearchTree;
use adrianschubek\Structures\Tree\BinaryTree;

/**
 * Copyright (c) 2020. Adrian Schubek
 * https://adriansoftware.de
 */
class Test2 extends PHPUnit\Framework\TestCase
{
    public function test_new_list()
    {
        $list = new DynamicList();
        $this->assertInstanceOf(DynamicList::class, $list);
    }

    public function test_to_array_list()
    {
        $list = new DynamicList();
        $list->append("Berlin");
        $list->append("Munich");
        $list->append("Cologne");

        $this->assertSame(["Berlin", "Munich", "Cologne"], $list->toArray());
    }

    public function test_concat_array_list()
    {
        $list = new DynamicList();
        $list->append("Berlin");
        $list->append("Munich");
        $list->append("Cologne");

        $list2 = new DynamicList();
        $list2->append("Düsseldorf");
        $list2->append("Essen");

        $list->concat($list2);

        $this->assertSame(["Berlin", "Munich", "Cologne", "Düsseldorf", "Essen"], $list->toArray());
    }

    public function test_concat_array_list_constructor()
    {
        $list = new DynamicList([
            "Berlin", "Munich", "Cologne"
        ]);

        $list2 = new DynamicList([
            "Düsseldorf", "Essen"
        ]);

        $list->concat($list2);

        $this->assertSame(["Berlin", "Munich", "Cologne", "Düsseldorf", "Essen"], $list->toArray());
    }

    public function test_diff_array_list_constructor()
    {
        $list = new DynamicList([
            "Berlin", "Munich", "Cologne"
        ]);

        $list2 = new DynamicList([
            "Munich", "Cologne"
        ]);

        $diff = $list->diff($list2);

        $this->assertSame(["Berlin"], $diff);
    }

    public function test_to_array_queue()
    {
        $queue = new Queue();
        $queue->enqueue("Berlin");
        $queue->enqueue("Munich");
        $queue->enqueue("Cologne");

        $this->assertSame(["Berlin", "Munich", "Cologne"], $queue->toArray());
    }

    public function test_dequeue_queue()
    {
        $queue = new Queue();
        $queue->enqueue("Berlin");
        $queue->enqueue("Munich");
        $queue->enqueue("Cologne");

        $queue->dequeue();

        $this->assertSame(["Munich", "Cologne"], $queue->toArray());
    }

    public function test_dequeue_queue_constructor()
    {
        $queue = new Queue([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $queue->dequeue();

        $this->assertSame(["Munich", "Cologne"], $queue->toArray());
    }

    public function test_deque_toarray()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $this->assertSame(["Berlin", "Munich", "Cologne"], $deque->toArray());
    }

    public function test_deque_2_toarray()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);
        $deque->pop();

        $deque2 = new Deque([
            "Düsseldorf",
            "Köln",
            "Essen"
        ]);

        $this->assertSame(["Düsseldorf", "Köln", "Essen"], $deque2->toArray());
    }

    public function test_deque_pop()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $deque->pop();

        $this->assertSame(["Berlin", "Munich"], $deque->toArray());
    }

    public function test_deque_push()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $deque->push("Hamburg");

        $this->assertSame(["Berlin", "Munich", "Cologne", "Hamburg"], $deque->toArray());
    }

    public function test_deque_unshift()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $deque->unshift("Hamburg");

        $this->assertSame(["Hamburg", "Berlin", "Munich", "Cologne"], $deque->toArray());
    }

    public function test_deque_first()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $ele = $deque->first();

        $this->assertSame("Berlin", $ele);
    }

    public function test_deque_last()
    {
        $deque = new Deque([
            "Berlin",
            "Munich",
            "Cologne"
        ]);

        $ele = $deque->last();

        $this->assertSame("Cologne", $ele);
    }

    public function test_binary_tree_init()
    {
        $tree = new BinaryTree("Berlin");
        $tree->setLeftTree(new BinaryTree("Hamburg"));
        $tree->setRightTree(new BinaryTree("Munich"));

        $this->assertInstanceOf(BinaryTree::class, $tree);
    }

    public function test_binary_searchtree_init()
    {
        $tree = new BinarySearchTree("Berlin");
        $tree->setLeftTree(new BinarySearchTree("Hamburg"));
        $tree->setRightTree(new BinarySearchTree("Munich"));

        $this->assertInstanceOf(BinarySearchTree::class, $tree);
    }



    public function test_binary_tree_converter()
    {
        $this->assertSame(0, 0);
    }
}
