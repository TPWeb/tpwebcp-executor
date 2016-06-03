<?php
namespace TPWeb\TPWebCP\Executor;

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
class CommandGenerator
{
    private $sudo_dir = "/usr/bin/sudo";
    private $useSudo = false;
    private $dir = "";
    
    private $command = "";
    private $arguments = [];
    
    private $output = "";
    
    function __construct($command = null, $arguments = []) {
        $this->setCommand($command);
        $this->setArguments($arguments);
        $this->generate();
    }
    
    public function setSudoDir($sudo) {
        $this->sudo_dir = $sudo;
    }
    
    public function getSudoDir() {
        return $this->sudo_dir;
    }
    
    public function setUseSudo($useSudo) {
        if(is_bool($useSudo)) {
            $this->useSudo = $useSudo;
        }
    }
    
    public function useSudo() {
        return $this->useSudo;
    }
    
    public function setCommandDir($dir) {
        $this->dir = $dir;
    }
    
    public function getCommandDir() {
        return $this->dir;
    }
    
    public function setCommand($command) {
        if($command != null && is_string($command))
            $this->command = $command;
    }
    
    public function getCommand() {
        return $this->command;
    }
    
    public function setArguments($arguments) {
        if (!is_array($arguments))
            $arguments = !is_null($arguments) ? [$arguments] : [];
        $this->arguments = $arguments;
    }
    
    public function getArguments() {
        return $this->arguments;
    }
    
    public function getOutput() {
        return $this->output;
    }
    
    /**
    * Execute a command line command
    *
    * @param string   $command     Command to execute. (eg. ls)
    * @param string[] $arguments   (optional) Unescaped command line arguments. (eg. ["We've", 'json'], default: [])
    */
    public function generate() {
        // Check command
        if (preg_match('#^\.*$|/#', $this->command))
            return -1;
        $cmd = "";
        if($this->useSudo()) {
            $cmd = $this->sudo_dir . " ";
        }
        if(strlen($this->getCommandDir()) > 0) {
            $cmd .= $this->getCommandDir();
        }
        $cmd .= $this->command;
        // Generate
        $arg = $this->build_shell_args($this->arguments);
        if (!empty($arg)) {
            $cmd .= " " . $arg;
        }
        $this->output = $cmd;
        return $cmd;
    }
    
    /**
    * Build shell command arguments from a string array.
    * @param string[] $arguments Unescaped command line arguments. (eg. ['-a', "b'c"], default: [])
    * @return string Escaped arguments.
    */
    private function build_shell_args($args) {
        $ret = [];
        foreach ($args as $arg) {
            // Convert $arg to a string if $arg is an array (for an argument like this: ?abc[def]=ghi)
            if (is_array($arg)) $arg = implode("", $arg);
            // Convert $arg to a string (just in case)
            if (!is_string($arg)) $arg = (string)$arg;
            // Append the argument
            $ret[] = escapeshellarg($arg);
        }
        return implode(" ", $ret);
    }
}
