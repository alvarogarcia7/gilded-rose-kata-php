<?php

declare(strict_types=1);

namespace Tests\Kata;

use PHPUnit\Framework\TestCase;
use Kata\GildedRose;
use Kata\Item;

final class GildedRose2Test extends TestCase
{
    public function testNormalItemBeforeSellDate(): void
    {
        $items = [new Item('Normal Item', 10, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(19, $items[0]->quality);
    }

    public function testNormalItemOnSellDate(): void
    {
        $items = [new Item('Normal Item', 0, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(18, $items[0]->quality);
    }

    public function testNormalItemAfterSellDate(): void
    {
        $items = [new Item('Normal Item', -5, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-6, $items[0]->sellIn);
        $this->assertSame(18, $items[0]->quality);
    }

    public function testNormalItemQualityNeverNegative(): void
    {
        $items = [new Item('Normal Item', 5, 0)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrieBeforeSellDate(): void
    {
        $items = [new Item('Aged Brie', 10, 30)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(31, $items[0]->quality);
    }

    public function testAgedBrieOnSellDate(): void
    {
        $items = [new Item('Aged Brie', 0, 30)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(32, $items[0]->quality);
    }

    public function testAgedBrieAfterSellDate(): void
    {
        $items = [new Item('Aged Brie', -5, 30)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-6, $items[0]->sellIn);
        $this->assertSame(32, $items[0]->quality);
    }

    public function testAgedBrieQualityMax50(): void
    {
        $items = [new Item('Aged Brie', 5, 50)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testSulfurasNeverSoldOrDecreasesInQuality(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 5, 80)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(5, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePassesMoreThan10Days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(14, $items[0]->sellIn);
        $this->assertSame(21, $items[0]->quality);
    }

    public function testBackstagePasses10DaysOrLess(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(22, $items[0]->quality);
    }

    public function testBackstagePasses5DaysOrLess(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(23, $items[0]->quality);
    }

    public function testBackstagePassesAfterConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testBackstagePassesQualityMax50(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testConjuredItemsDegradeTwiceAsFast(): void
    {
        self::markTestIncomplete();
        // Asumiendo que "Conjured" está implementado
        $items = [new Item('Conjured Mana Cake', 3, 6)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testConjuredItemsAfterSellDate(): void
    {
        self::markTestIncomplete();
        // Asumiendo que "Conjured" está implementado
        $items = [new Item('Conjured Mana Cake', 0, 6)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(2, $items[0]->quality);
    }

    public function testConjuredItemsQualityNeverNegative(): void
    {
        self::markTestIncomplete();
        // Asumiendo que "Conjured" está implementado
        $items = [new Item('Conjured Mana Cake', 3, 0)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }
}