# Structures
[![Latest Stable Version](https://poser.pugx.org/adrianschubek/structures/v)](//packagist.org/packages/adrianschubek/structures)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/adrianschubek/structures)
[![License](https://poser.pugx.org/adrianschubek/structures/license)](//packagist.org/packages/adrianschubek/structures)

This package intoduces multiple new data structures such as Trees, Lists and Wrappers.

### Data structures
  - Linear
    - Queue
    - Deque
    - Stack
    - List
  - Tree
    - BinaryTree
    - BinarySearchTree
  - Wrapper
    - StringWrapper
    - IntWrapper
    - FloatWrapper

### Get started
```
composer require adrianschubek/structures
```
### Examples
Check `/tests` directory for more examples.
##### Queue
```php
use adrianschubek\Structures\Linear\Queue;

$queue = new Queue();
$queue->enqueue("Berlin");
$queue->enqueue("Munich");
$queue->enqueue("Cologne");

$queue->dequeue();

$arr = $queue->toArray();
// ==> ["Munich", "Cologne"]
```
##### List
```php
use adrianschubek\Structures\Linear\DynamicList;

$list = new DynamicList();

$list->append("Berlin");
$list->append("Munich");
$list->append("Cologne");

$list2 = new DynamicList();
$list2->append("Düsseldorf");
$list2->append("Essen");

$list->concat($list2);
// ==> ["Berlin", "Munich", "Cologne", "Düsseldorf", "Essen"]
```
```php
use adrianschubek\Structures\Linear\DynamicList;

$list = new DynamicList([
    "Berlin", "Munich", "Cologne"
]);

$list2 = new DynamicList([
    "Munich", "Cologne"
]);

$diff = $list->diff($list2); 
// ==> ["Berlin"]
```
##### Deque
```php
use adrianschubek\Structures\Linear\Deque;

$deque = new Deque([
    "Berlin",
    "Munich",
    "Cologne"
]);

$deque->pop();

$ele = $deque->last();
// ==> "Munich"
```
##### BinaryTree
```php
use adrianschubek\Structures\Tree\BinaryTree;

$tree = new BinaryTree("Berlin");
$tree->setLeftTree(new BinaryTree("Hamburg"));
$tree->setRightTree(new BinaryTree("Munich"));

$ele = $tree->getLeftTree()->getContent();
// ==> "Hamburg"
```
##### BinarySearchTree
```php
use adrianschubek\Structures\Tree\BinarySearchTree;
use adrianschubek\Structures\Wrapper\StringWrapper;

$tree = new BinarySearchTree("Berlin");
$tree->insert(new StringWrapper("Hamburg"));
$tree->insert(new StringWrapper("Munich"));
$tree->insert(new StringWrapper("Frankfurt"));
// OR
$tree = BinarySearchTree::fromArray(["Berlin", "Hamburg", "Munich", "Frankfurt"]);
// OR
$tree = BinarySearchTree::fromString("Berlin,Munich,Frankfurt,Hamburg");

$tree->search(new StringWrapper("Frankfurt"));
// ==> "Frankfurt"

$tree->search(new StringWrapper("Mainz"));
// ==> null
```