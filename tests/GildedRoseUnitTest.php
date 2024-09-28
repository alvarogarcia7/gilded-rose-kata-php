<?php

declare(strict_types=1);

namespace Kata\Test;

use Kata\GildedRose;
use Kata\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseUnitTest extends TestCase
{
    public function testQualityDecreasesByOneForNormalItem(): void
    {
        $items = [new Item('normal', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(19, $items[0]->quality);
    }

    public function testQualityDecreasesTwiceAsFastAfterSellIn(): void
    {
        $items = [new Item('normal', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(18, $items[0]->quality);
    }

    public function testQualityOfAgedBrieIncreases(): void
    {
        $items = [new Item('Aged Brie', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(21, $items[0]->quality);
    }

    public function testQualityOfBackstagePassesIncreases(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(21, $items[0]->quality);
    }

    public function testQualityOfBackstagePassesIncreasesByTwoWhenSellInLessThanTen(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 9, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(22, $items[0]->quality);
    }

    public function testQualityOfBackstagePassesIncreasesByThreeWhenSellInLessThanFive(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 4, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(23, $items[0]->quality);
    }

    public function testQualityOfBackstagePassesDropsToZeroAfterConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityOfSulfurasNeverChanges(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(80, $items[0]->quality);
    }
}