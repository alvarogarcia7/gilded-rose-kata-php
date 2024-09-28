<?php
declare(strict_types=1);

namespace Tests\Kata;

use ApprovalTests\Approvals;
use Kata\GildedRose;
use Kata\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseApprovalTest extends TestCase
{
    public function testUpdateQuality(): void
    {
        $items = [
            new Item('normal', 10, 20),
            new Item('normal', 0, 20),
            new Item('Aged Brie', 10, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 9, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 4, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('normal', 10, 0),
            new Item('Aged Brie', 10, 50),
            new Item('normal', 10, 20),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Aged Brie', 0, 20),
            new Item('normal', 0, 0)
        ];

        $gildedRose = new GildedRose($items);

        for ($i = 0; $i < 10; $i++) {
            $gildedRose->updateQuality();
        }

        Approvals::verifyList($items);
    }
}