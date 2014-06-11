<?php
/**
 * @author Philip Snyder <philip.r.snyder@gmail.com>
 */



/**
 * Manages reading configuration files and fetching values.
 * @todo take Zend config class and implement it without requiring all of zend. I like it better than mine is why.
 */
class Config {

    /**
     * Default configuration file name.
     */
    const DEFAULT_CONFIG = 'default';




    /**
     * Returns a config instance, loaded statically.
     *
     * @static
     * @access public
     * @param  string  $configFile  Configuration file to load (without extension). Defaults to static::DEFAULT_CONFIG (Config::DEFAULT_CONFIG => 'default').
     * @param  bool    $force       Forces a reload of the configuration file. Defaults to false.
     * @return Config
     */
    static public function getInstance($configFile=null, $force=false) {
        if (is_null($configFile)) {
            $configFile = static::DEFAULT_CONFIG;
        }
        if (!isset(static::$instances[$configFile])) {
            static::$instances[$configFile] = new static($configFile, $force);
        }
        return static::$instances[$configFile];
    }





    /**
     * Static array to hold instances of Config class.
     *
     * @static
     * @access protected
     * @var    array  $instances
     */
    static protected $instances = array();

    /**
     * Generates the config file's path.
     * Note: DO NOT store the value in the object for security purposes as that would give away filesystem path information.
     *
     * @static
     * @final
     * @access protected
     * @param  string  $configFile
     * @return string
     */
    static final protected function getConfigFilePath($configFile) {
        $file = join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), '..', 'config', $configFile.'.ini'));
        error_log('file: '.$file);
        return $file;
    }




    /**
     * Returns the value from a config variable.
     * 
     * @param  string  $section   Config section as identified by [section_name] lines according to ini format.
     * @param  string  $name      Config variable name.
     * @return mixed
     * @throws OutOfRangeException
     */
    public function get($section, $name) {
        $this->load();
        if (!isset($this->configData[$section][$name])) {
            throw new OutOfRangeException('Config variable not set: '.$section.'->'.$name);
        }
        return $this->configData[$section][$name];
    }




    /**
     * Holds the config file name (without extension).
     *
     * @access protected
     * @var   $configFile
     * @type  string
     */
    protected $configFile = null;

    /**
     * Holds the config file data after being parsed.
     *
     * @access protected
     * @var    $configData
     * @type   array<mixed>
     */
    protected $configData = null;

    /**
     * Constructor for Config class that has access restricted to require instantiation via static::getInstance().
     * 
     * @access protected
     * @param  string  $configFile  Configuration file to load (without extension). Defaults to static::DEFAULT_CONFIG (Config::DEFAULT_CONFIG => 'default').
     * @param  bool    $force       Forces a reload of the configuration file. Defaults to false.
     * @return Config
     * @throws Exception_FileNotFound
     */
    protected function __construct($configFile=null, $force=false) {
        if (is_null($configFile)) {
            $configFile = static::DEFAULT_CONFIG;
        }
        if (!file_exists(static::getConfigFilePath($configFile))) {
            throw new Exception_FileNotFound('Configuration file not found: '.$configFile);
        }
        $this->configFile = $configFile;
    }

    /**
     * Parses the config ini file if it has not been parsed already or is forced to do so.
     *
     * @access protected
     * @param  bool  $force  Forces parsing of the file, Default is false.
     */
    protected function load($force=false) {
        if ($force || is_null($this->configData)) {
            $this->configData = parse_ini_file(static::getConfigFilePath($this->configFile), true);
        }
    }

}

