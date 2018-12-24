<?php
require 'RedisLock.class.php';

$config = array(
    'host' => 'localhost',
    'port' => 6379,
    'index' => 0,
    'auth' => '',
    'timeout' => 1,
    'reserved' => NULL,
    'retry_interval' => 100,    //连接断开后每隔几秒后重试
);

// 创建redislock对象
$oRedisLock = new RedisLock($config);

// 定义锁标识
$key = 'mylock';

// 获取锁
$is_lock = $oRedisLock->lock($key, 10);

if($is_lock){   //获取锁成功, 可以操作
    echo 'get lock success<br>';
    echo 'do sth..<br>';
    sleep(5);
    echo 'success<br>';
    $oRedisLock->unlock($key);

// 获取锁失败
}else{        //获取锁失败, 不可以继续提交
    echo 'request too frequently<br>';
}

?>
