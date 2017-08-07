<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBiosTest\Assetic;

use MSBios\Assetic\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package MSBiosTest\Assetic
 */
class ModuleTest extends TestCase
{
    /**
     *
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', (new Module)->getAutoloaderConfig());
    }
}
