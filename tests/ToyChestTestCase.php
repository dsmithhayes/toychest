<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use ToyChest\ToyChest;

class ToyChestTestCase extends PHPUnitTestCase
{
    public function testToyChest()
    {
        $container = new ToyChest();

        $container['array'] = ['key' => 'value'];
        $this->assertArrayHasKey('key', $container['array']);

        $container['object'] = function ($container) {
            return new class
            {
                public function theClassExists()
                {
                    return true;
                }
            };
        };

        $this->assertTrue($container['object']->theClassExists());
    }
}
