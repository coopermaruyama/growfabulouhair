<?php
/**
 * @author Philip Snyder <philip.r.snyder@gmail.com>
 */

/**
 * Handles connection to the database, using DOCROOT/../config/db.ini for configuration options.
 *
 */
class Database {

    /**
     * Defines default connection key.
     */
    const CONNECTION_DEFAULT = 'default';

    /**
     * Holds instances of database connections for later use.
     *
     * @static
     * @access protected
     */
    protected static $connections = array();

    /**
     * Instantiates and returns PDO connection reqeusted.
     *
     * @static
     * @access public
     * @param  string  $connType   Label of the database connection (from db.ini config file)
     * @return PDO
     */
    public static function getConnection($connType=self::CONNECTION_DEFAULT) {
        $configFile = realpath(__DIR__.'/../../config/db.ini');
        $config     = parse_ini_file($configFile, true);
        if (!isset(self::$connections[$connType])) {
            switch ($connType) {
                case self::CONNECTION_DEFAULT:
                    $config = $config[self::CONNECTION_DEFAULT];
                    //error_log('database config: '.print_r($config, true));
                    $dsn    = $config['driver'].":host=".$config['hostname'].";port=".$config['port'].";dbname=".$config['database'];
                    $conn   = new PDO($dsn, $config['username'], $config['password']);
                    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    if ($conn) {
                        self::$connections[$connType] = $conn;
                    } else {
                        throw new Exception('Unable to open database connection: '.$connType);
                    }
                    break;
                default:
                    throw new Exception('Invalid Database Connection');
            }
        }
        return self::$connections[$connType];
    }

}

