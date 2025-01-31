<?php

/* * *
 *      _____            _  _
 *     |  __ \          | |(_)
 *     | |__) | ___   __| | _  ___
 *     |  _  / / _ \ / _` || |/ __|
 *     | | \ \|  __/| (_| || |\__ \
 *     |_|  \_\\___| \__,_||_||___/
 *
 *    A libarary having normal functions of php and redis
 *    While written I used redis 4.* version
 *    fx -: means function in this file
 *    follow link https://www.hugeserver.com/kb/install-redis-centos/ for installation
 *    http://webd.is/ for many things 
 */

Class Redis_magic {

    public $redis = 0;

    public function __construct() {
        require APPPATH . "third_party/predis/autoload.php";
        Predis\Autoloader::register();

        $redis_config = array(
            "scheme" => "tcp",
            "host" => defined("CONFIG_REDIS_HOST") ? CONFIG_REDIS_HOST : 'localhost',
            "port" => defined("CONFIG_REDIS_PORT") ? CONFIG_REDIS_PORT : 6379
        );
        if (defined("CONFIG_REDIS_PASSWORD") && CONFIG_REDIS_PASSWORD)
            $redis_config['password'] = CONFIG_REDIS_PASSWORD;

        $this->redis = new Predis\Client($redis_config);
    }

    /* fx to set a value  for respcetive key */

    public function SET($key, $value) {
        return $this->redis->SET($key, $value);
    }

    /* fx to get a value from key */

    public function GET($key) {
        return $this->redis->GET($key);
    }

    /* set key with expiry in seconds */

    public function SETEX($key, $seconds, $value) {
        return $this->redis->SETEX($key, $seconds, $value);
    }

    /* check variables living time */

    public function TTL($key) {
        return $this->redis->TTL($key);
    }

    /* expire variables living time */

    public function EXPIRE($key, $seconds) {
        return $this->redis->EXPIRE($key, $seconds);
    }

    /* Redis sets
     * https://redis.io/commands/hexists
     */
    /* set an array */

    public function HMSET($table, $u_id, $data) {
        $this->redis->HMSET($table . ':' . $u_id, $data);
        $this->redis->SADD($table . ':Ids', $u_id);
    }

    public function HGETALL($table, $index) {
        if ($index && is_array($index)) {
            $pipeline = $this->redis->pipeline();
            foreach ($index as $val) {
                $pipeline->HGETALL($table . ":" . $val);
            }
            return array_combine($index, $pipeline->execute());
        } else if (is_string($index) || is_int($index))
            return $this->redis->HGETALL($table . ':' . $index);
    }

    public function EXPIRE_HMSET_KEY($table, $u_id, $seconds) {
        $this->redis->EXPIRE($table . ':' . $u_id, $seconds);
    }

    /* Publish a message */

    public function PUBLISH($channel_name, $message) {
        return $this->redis->PUBLISH($channel_name, $message);
    }

}
