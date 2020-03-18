<?php

use adrianschubek\Structures\Linear\DynamicList;

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
}
