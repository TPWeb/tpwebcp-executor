<?php
use TPWeb\TPWebCP\Executor\Executor;
use TPWeb\TPWebCP\Executor\CommandGenerator;

class ExecutorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testConstructor() {
        $executor = new Executor("ls");
        $this->assertEquals(0, $executor->exec());
        
        
        $executor = new Executor("ls", "-la");
        $this->assertEquals(0, $executor->exec());
    }
    
    public function testSetGetCommand() {
        $command = new CommandGenerator("ls");
        $executor = new Executor;
        $executor->setCommand($command);
        $this->assertEquals($command, $executor->getCommand());
    }
    
    public function testGetOutput() {
        $executor = new Executor("ls");
        $output = "";
        $this->assertEquals(0, $executor->exec($output));
        $this->assertEquals("composer.json
composer.lock
LICENSE
phpunit.xml
readme.md
src
tests
vendor", $output);
        $this->assertEquals(['composer.json', 'composer.lock', 'coverage', 'LICENSE', 'phpunit.xml', 'readme.md', 'src', 'tests', 'vendor'], $executor->getResult());
    }
}