<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use ToyChest\ToyChest;

class ToyChestTestCase extends PHPUnitTestCase
{
    public function testToyChest()
    {
        $contaienr = new ToyChest();

        $container['array'] = ['key' => 'value'];
        $this->assertArrayHasKey('key', $container['array']);

        $container['object'] = function ($container) {
            $newClass = new class
            {
                public function theClassExists()
                {
                    return true;
                }
            };

            return $newClass;
        };

        $this->assertTrue($container['object']>theClassExists());
    }
}
