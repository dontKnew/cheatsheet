# Redis Cache with PHP Guide

### 1. Install and Start Redis Server
```bash
sudo apt install redis-server
sudo systemctl start redis-server
sudo systemctl enable redis-server
sudo systemctl status redis-server
```

### 2. Define Port and Password
#### Edit Redis Configuration
```bash
sudo nano /etc/redis/redis.conf
```

- Search for `port` and set your preferred port (default is `6379`).
- Ensure the port is allowed in the firewall.

#### Allow Port 6379 in the Firewall
##### Using UFW:
```bash
sudo ufw allow 6379/tcp
sudo ufw status
sudo ufw reload
```

##### Using Iptables:
```bash
sudo iptables -A INPUT -p tcp --dport 6379 -j ACCEPT
sudo apt install iptables-persistent
sudo netfilter-persistent save
sudo iptables -L  # Verify rule for port 6379
```

- Search for `requirepass` in the `redis.conf` file and set a password (optional).

### 3. Test Redis Server via CLI
```bash
redis-cli
PING  # Output should be PONG
```

### 4. Install PHP Redis Extension
```bash
sudo apt install php8.3-redis
```

### 5. Enable Redis Extension in PHP
Edit the PHP configuration files:

```bash
nano /etc/php/8.3/fpm/php.ini
nano /etc/php/8.3/cli/php.ini
```
Add:
```ini
extension=redis.so
```

### 6. Verify Redis Extension Installation
```bash
php8.3 -i | grep extension_dir
```
- Output should show: `extension_dir => /usr/lib/php/20230831`
- Check for `redis.so` in `/usr/lib/php/20230831`.

### 7. Testing PHP Code with Redis
```php
<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$redis = new Redis();
try {
    // Connect to Redis server
    $redis->connect('127.0.0.1', 6379);

    // Authenticate with the Redis server
    $redis->auth('your_redis_password'); 

    // Set and get a value in Redis
    $redis->set('test_key', 'Hello Redis');
    echo "Stored value: " . $redis->get('test_key');  // Output: Hello Redis
} catch (RedisException $e) {
    echo "Couldn't connect to Redis: " . $e->getMessage();
}
?>
```

### 8. Store Redis Data Permanently
Edit the Redis configuration file to enable persistent storage:
```bash
sudo nano /etc/redis/redis.conf
```
- Search for `appendonly` and change the value from `no` to `yes`.
- Restart Redis:
```bash
sudo systemctl restart redis
```

#### Verify and Test Persistence:
```bash
redis-cli
CONFIG GET appendonly  # Output should be "yes"
SET mytestkey "persistent_data"  # Set a test key
```
- Restart Redis or reboot the system:
```bash
sudo systemctl restart redis
```
- Retrieve the test key:
```bash
redis-cli GET mytestkey
```
- To remove all keys:
```bash
redis-cli FLUSHALL
```
- To delete specific keys:
```bash
redis-cli DEL [key_name]
```

### 9. Redis Key Management Outside CLI
- List keys by pattern:
```bash
redis-cli --scan --pattern "digitech*"
```
- Delete keys based on a pattern:
```bash
redis-cli EVAL "for _,k in ipairs(redis.call('keys', ARGV[1])) do redis.call('del', k) end" 0 "digitech*"
```

This guide will help you set up Redis with PHP, manage keys, and ensure persistent storage.
