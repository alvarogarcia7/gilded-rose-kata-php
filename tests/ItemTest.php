<?php
declare(strict_types=1);

namespace Kata\Test;

use Kata\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testToString(): void
    {
        $item = new Item('normal', 10, 20);
        $this->assertSame('normal, 10, 20', (string)$item);
    }
}