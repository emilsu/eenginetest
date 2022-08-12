<?php
require_once('.\money.php');
use Eengine\Money\Money;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    public function testClassConstructor()
    {
        $money = new Money(18, 'PLN');

        $this->assertInstanceOf(Money::class, $money);
        $this->assertNotEquals(new Money(18, 'EUR'), $money);
    }

    public function testAdd()
    {
        $money = new Money(18, 'PLN');
        $money2 = new Money(13, 'PLN');
        $money3 = new Money(18, 'EUR');

        $this->assertEquals((new Money(18, 'PLN'))->add($money2), $money->add($money2));
        $this->assertEquals(new Money(31, 'PLN'), $money->add($money2));
        $this->assertSame('Currencies are not the same', $money->add($money3));
    }

    public function testSub()
    {
        $money = new Money(18, 'PLN');
        $money2 = new Money(13, 'PLN');
        $money3 = new Money(18, 'EUR');

        $this->assertEquals((new Money(18, 'PLN'))->sub($money2), $money->sub($money2));
        $this->assertEquals(new Money(5, 'PLN'), $money->sub($money2));
        $this->assertSame('Currencies are not the same', $money->sub($money3));
    }

    public function testMul()
    {
        $money = new Money(18, 'PLN');

        $this->assertEquals(new Money(36, 'PLN'), $money->mul(2));
        $this->assertEquals(new Money(-36, 'PLN'), $money->mul(-2));
        $this->assertEquals(new Money(0, 'PLN'), $money->mul(0));
        $this->assertEquals(new Money(18, 'PLN'), $money->mul(1));
    }

    public function testDiv()
    {
        $money = new Money(18, 'PLN');

        $this->assertEquals(new Money(9, 'PLN'), $money->div(2));
        $this->assertEquals(new Money(-9, 'PLN'), $money->div(-2));
        $this->assertSame('Division by 0 is not allowed', $money->div(0));
    }
}