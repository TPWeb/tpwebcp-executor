<?php
use TPWeb\TPWebCP\Executor\Executor;
use TPWeb\TPWebCP\Executor\CommandGenerator;

class CommandGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testConstructor() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("ls");
        $this->assertEquals("ls", $generator->getCommand());
        
        
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("ls", "-a");
        $this->assertEquals("ls", $generator->getCommand());
        $this->assertEquals(["-a"], $generator->getArguments());
    }
    
    public function testSetGetSudoDir() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator;
        $this->assertEquals("/usr/bin/sudo", $generator->getSudoDir());
        $generator->setSudoDir("abc");
        $this->assertEquals("abc", $generator->getSudoDir());
    }
    
    public function testSetGetUseSudo() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator;
        $this->assertEquals(false, $generator->useSudo());
        $generator->setUseSudo(true);
        $this->assertEquals(true, $generator->useSudo());
        $generator->setUseSudo(false);
        $this->assertEquals(false, $generator->useSudo());
        $generator->setUseSudo("ABC");
        $this->assertEquals(false, $generator->useSudo());
    }
    
    public function testSetGetCommandDir() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator;
        $this->assertEquals("", $generator->getCommandDir());
        $generator->setCommandDir("abc");
        $this->assertEquals("abc", $generator->getCommandDir());
    }
    
    public function testCommandOutput() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("ls");
        $this->assertEquals("", $generator->getCommandDir());
        $this->assertEquals(false, $generator->useSudo());
        $this->assertEquals("ls", $generator->getCommand());
        $this->assertEquals("ls", $generator->generate());
        $this->assertEquals("ls", $generator->getOutput());
    }
    
    public function testCommandWithArgsOutput() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("ls", ["-a"]);
        $this->assertEquals("", $generator->getCommandDir());
        $this->assertEquals(false, $generator->useSudo());
        $this->assertEquals("ls", $generator->getCommand());
        $this->assertEquals(["-a"], $generator->getArguments());
        $this->assertEquals("ls '-a'", $generator->generate());
        $this->assertEquals("ls '-a'", $generator->getOutput());
    }
    
    public function testCommandSudo() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("ls", ["-a"]);
        $generator->setUseSudo(true);
        $this->assertEquals("", $generator->getCommandDir());
        $this->assertEquals(true, $generator->useSudo());
        $this->assertEquals("ls", $generator->getCommand());
        $this->assertEquals(["-a"], $generator->getArguments());
        $this->assertEquals("/usr/bin/sudo ls '-a'", $generator->generate());
        $this->assertEquals("/usr/bin/sudo ls '-a'", $generator->getOutput());
    }
    
    public function testCommandWithCommandDir() {
        $generator = new TPWeb\TPWebCP\Executor\CommandGenerator("test.sh", ["--name=test"]);
        $generator->setUseSudo(true);
        $generator->setCommandDir("/tmp/test/");
        $this->assertEquals("/tmp/test/", $generator->getCommandDir());
        $this->assertEquals(true, $generator->useSudo());
        $this->assertEquals("test.sh", $generator->getCommand());
        $this->assertEquals(["--name=test"], $generator->getArguments());
        $this->assertEquals("/usr/bin/sudo /tmp/test/test.sh '--name=test'", $generator->generate());
        $this->assertEquals("/usr/bin/sudo /tmp/test/test.sh '--name=test'", $generator->getOutput());
    }
}