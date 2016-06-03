<?php
namespace TPWeb\TPWebCP\Executor;

use TPWeb\TPWebCP\Executor\CommandGenerator;
/**
 *
 * PHP Executor Library for TPWebCP
 *
 * @version    1.0.0
 * @package    tpweb/tpwebcp-executor
 * @copyright  Copyright (c) 2016 Made I.T. (http://www.madeit.be) - TPWeb.org (http://www.tpweb.org)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Executor
{
    protected $SUDO_CMD = "/usr/bin/sudo";
    private $command;
    private $result;
    
    function __construct($command = null, $arguments = []) {
        $this->command = new CommandGenerator($command, $arguments);
    }
    
    public function setCommand(CommandGenerator $command) {
        $this->command = $command;
    }
    
    public function getCommand() {
        return $this->command;
    }
    
    public function getResult() {
        return $this->result;
    }
    
    /**
    * Execute a command.
    * @param string   &$output   (optional) Variable to contain output from the command.
    * @return int Exit code (return status) of the executed command.
    */
    public function exec(&$output = null) {
        // Execute
        exec($this->command->getOutput(), $rawOutput, $status);
        $output = implode("\n", $rawOutput);
        $this->result = $rawOutput;
        return $status;
    }
}
