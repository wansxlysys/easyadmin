<?php


namespace app\common\helper;


use Predis\Client;
use think\facade\Config;
use Predis\Response\Status;
use Predis\Command\Argument\Server\To;
use Predis\Command\Argument\Geospatial\ByInterface;
use Predis\Command\Argument\Server\LimitOffsetCount;
use Predis\Command\Argument\Geospatial\FromInterface;

/**
 * @see Client
 * @method static int               copy(string $source, string $destination, int $db = -1, bool $replace = false)
 * @method static int               del(string[]|string $keyOrKeys, string ...$keys = null)
 * @method static string|null       dump(string $key)
 * @method static int               exists(string $key)
 * @method static int               expire(string $key, int $seconds, string $expireOption = '')
 * @method static int               expireat(string $key, int $timestamp, string $expireOption = '')
 * @method static int               expiretime(string $key)
 * @method static array             keys(string $pattern)
 * @method static int               move(string $key, int $db)
 * @method static mixed             object($subcommand, string $key)
 * @method static int               persist(string $key)
 * @method static int               pexpire(string $key, int $milliseconds)
 * @method static int               pexpireat(string $key, int $timestamp)
 * @method static int               pttl(string $key)
 * @method static string|null       randomkey()
 * @method static mixed             rename(string $key, string $target)
 * @method static int               renamenx(string $key, string $target)
 * @method static array             scan($cursor, array $options = null)
 * @method static array             sort(string $key, array $options = null)
 * @method static array             sort_ro(string $key, ?string $byPattern = null, ?LimitOffsetCount $limit = null, array $getPatterns = [], ?string $sorting = null, bool $alpha = false)
 * @method static int               ttl(string $key)
 * @method static mixed             type(string $key)
 * @method static int               append(string $key, $value)
 * @method static int               bitcount(string $key, $start = null, $end = null, string $index = 'byte')
 * @method static int               bitop($operation, $destkey, $key)
 * @method static array|null        bitfield(string $key, $subcommand, ...$subcommandArg)
 * @method static int               bitpos(string $key, $bit, $start = null, $end = null, string $index = 'byte')
 * @method static array             blmpop(int $timeout, array $keys, string $modifier = 'left', int $count = 1)
 * @method static array             bzpopmax(array $keys, int $timeout)
 * @method static array             bzpopmin(array $keys, int $timeout)
 * @method static array             bzmpop(int $timeout, array $keys, string $modifier = 'min', int $count = 1)
 * @method static int               decr(string $key)
 * @method static int               decrby(string $key, int $decrement)
 * @method static Status            failover(?To $to = null, bool $abort = false, int $timeout = -1)
 * @method static mixed             fcall(string $function, array $keys, ...$args)
 * @method static string|null       get(string $key)
 * @method static int               getbit(string $key, $offset)
 * @method static int|null          getex(string $key, $modifier = '', $value = false)
 * @method static string            getrange(string $key, $start, $end)
 * @method static string            getdel(string $key)
 * @method static string|null       getset(string $key, $value)
 * @method static int               incr(string $key)
 * @method static int               incrby(string $key, int $increment)
 * @method static string            incrbyfloat(string $key, int|float $increment)
 * @method static array             mget(string[]|string $keyOrKeys, string ...$keys = null)
 * @method static mixed             mset(array $dictionary)
 * @method static int               msetnx(array $dictionary)
 * @method static Status            psetex(string $key, $milliseconds, $value)
 * @method static Status            set(string $key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
 * @method static int               setbit(string $key, $offset, $value)
 * @method static Status            setex(string $key, $seconds, $value)
 * @method static int               setnx(string $key, $value)
 * @method static int               setrange(string $key, $offset, $value)
 * @method static int               strlen(string $key)
 * @method static int               hdel(string $key, array $fields)
 * @method static int               hexists(string $key, string $field)
 * @method static string|null       hget(string $key, string $field)
 * @method static array             hgetall(string $key)
 * @method static int               hincrby(string $key, string $field, int $increment)
 * @method static string            hincrbyfloat(string $key, string $field, int|float $increment)
 * @method static array             hkeys(string $key)
 * @method static int               hlen(string $key)
 * @method static array             hmget(string $key, array $fields)
 * @method static mixed             hmset(string $key, array $dictionary)
 * @method static array             hrandfield(string $key, int $count = 1, bool $withValues = false)
 * @method static array             hscan(string $key, $cursor, array $options = null)
 * @method static int               hset(string $key, string $field, string $value)
 * @method static int               hsetnx(string $key, string $field, string $value)
 * @method static array             hvals(string $key)
 * @method static int               hstrlen(string $key, string $field)
 * @method static string            blmove(string $source, string $destination, string $where, string $to, int $timeout)
 * @method static array|null        blpop(array|string $keys, int|float $timeout)
 * @method static array|null        brpop(array|string $keys, int|float $timeout)
 * @method static string|null       brpoplpush(string $source, string $destination, int|float $timeout)
 * @method static mixed             lcs(string $key1, string $key2, bool $len = false, bool $idx = false, int $minMatchLen = 0, bool $withMatchLen = false)
 * @method static string|null       lindex(string $key, int $index)
 * @method static int               linsert(string $key, $whence, $pivot, $value)
 * @method static int               llen(string $key)
 * @method static string            lmove(string $source, string $destination, string $where, string $to)
 * @method static array|null        lmpop(array $keys, string $modifier = 'left', int $count = 1)
 * @method static string|null       lpop(string $key)
 * @method static int               lpush(string $key, array $values)
 * @method static int               lpushx(string $key, array $values)
 * @method static string[]          lrange(string $key, int $start, int $stop)
 * @method static int               lrem(string $key, int $count, string $value)
 * @method static mixed             lset(string $key, int $index, string $value)
 * @method static mixed             ltrim(string $key, int $start, int $stop)
 * @method static string|null       rpop(string $key)
 * @method static string|null       rpoplpush(string $source, string $destination)
 * @method static int               rpush(string $key, array $values)
 * @method static int               rpushx(string $key, array $values)
 * @method static int               sadd(string $key, array $members)
 * @method static int               scard(string $key)
 * @method static string[]          sdiff(array|string $keys)
 * @method static int               sdiffstore(string $destination, array|string $keys)
 * @method static string[]          sinter(array|string $keys)
 * @method static int               sintercard(array $keys, int $limit = 0)
 * @method static int               sinterstore(string $destination, array|string $keys)
 * @method static int               sismember(string $key, string $member)
 * @method static string[]          smembers(string $key)
 * @method static array             smismember(string $key, string ...$members)
 * @method static int               smove(string $source, string $destination, string $member)
 * @method static string|array|null spop(string $key, int $count = null)
 * @method static string|null       srandmember(string $key, int $count = null)
 * @method static int               srem(string $key, array|string $member)
 * @method static array             sscan(string $key, int $cursor, array $options = null)
 * @method static string[]          sunion(array|string $keys)
 * @method static int               sunionstore(string $destination, array|string $keys)
 * @method static int               touch(string[]|string $keyOrKeys, string ...$keys = null)
 * @method static string            xadd(string $key, array $dictionary, string $id = '*', array $options = null)
 * @method static int               xdel(string $key, string ...$id)
 * @method static int               xlen(string $key)
 * @method static array             xrevrange(string $key, string $end, string $start, ?int $count = null)
 * @method static array             xrange(string $key, string $start, string $end, ?int $count = null)
 * @method static string            xtrim(string $key, array|string $strategy, string $threshold, array $options = null)
 * @method static int               zadd(string $key, array $membersAndScoresDictionary)
 * @method static int               zcard(string $key)
 * @method static string            zcount(string $key, int|string $min, int|string $max)
 * @method static array             zdiff(array $keys, bool $withScores = false)
 * @method static int               zdiffstore(string $destination, array $keys)
 * @method static string            zincrby(string $key, int $increment, string $member)
 * @method static int               zintercard(array $keys, int $limit = 0)
 * @method static int               zinterstore(string $destination, array $keys, int[] $weights = [], string $aggregate = 'sum')
 * @method static array             zinter(array $keys, int[] $weights = [], string $aggregate = 'sum', bool $withScores = false)
 * @method static array             zmpop(array $keys, string $modifier = 'min', int $count = 1)
 * @method static array             zmscore(string $key, string ...$member)
 * @method static array             zpopmin(string $key, int $count = 1)
 * @method static array             zpopmax(string $key, int $count = 1)
 * @method static mixed             zrandmember(string $key, int $count = 1, bool $withScores = false)
 * @method static array             zrange(string $key, int|string $start, int|string $stop, array $options = null)
 * @method static array             zrangebyscore(string $key, int|string $min, int|string $max, array $options = null)
 * @method static int               zrangestore(string $destination, string $source, int|string $min, int|string $max, string|bool $by = false, bool $reversed = false, bool $limit = false, int $offset = 0, int $count = 0)
 * @method static int|null          zrank(string $key, string $member)
 * @method static int               zrem(string $key, string ...$member)
 * @method static int               zremrangebyrank(string $key, int|string $start, int|string $stop)
 * @method static int               zremrangebyscore(string $key, int|string $min, int|string $max)
 * @method static array             zrevrange(string $key, int|string $start, int|string $stop, array $options = null)
 * @method static array             zrevrangebyscore(string $key, int|string $max, int|string $min, array $options = null)
 * @method static int|null          zrevrank(string $key, string $member)
 * @method static array             zunion(array $keys, int[] $weights = [], string $aggregate = 'sum', bool $withScores = false)
 * @method static int               zunionstore(string $destination, array $keys, int[] $weights = [], string $aggregate = 'sum')
 * @method static string|null       zscore(string $key, string $member)
 * @method static array             zscan(string $key, int $cursor, array $options = null)
 * @method static array             zrangebylex(string $key, string $start, string $stop, array $options = null)
 * @method static array             zrevrangebylex(string $key, string $start, string $stop, array $options = null)
 * @method static int               zremrangebylex(string $key, string $min, string $max)
 * @method static int               zlexcount(string $key, string $min, string $max)
 * @method static int               pexpiretime(string $key)
 * @method static int               pfadd(string $key, array $elements)
 * @method static mixed             pfmerge(string $destinationKey, array|string $sourceKeys)
 * @method static int               pfcount(string[]|string $keyOrKeys, string ...$keys = null)
 * @method static mixed             pubsub($subcommand, $argument)
 * @method static int               publish($channel, $message)
 * @method static mixed             discard()
 * @method static array|null        exec()
 * @method static mixed             multi()
 * @method static mixed             unwatch()
 * @method static mixed             watch(string $key)
 * @method static mixed             eval(string $script, int $numkeys, string ...$keyOrArg = null)
 * @method static mixed             eval_ro(string $script, array $keys, ...$argument)
 * @method static mixed             evalsha(string $script, int $numkeys, string ...$keyOrArg = null)
 * @method static mixed             evalsha_ro(string $sha1, array $keys, ...$argument)
 * @method static mixed             script($subcommand, $argument = null)
 * @method static mixed             auth(string $password)
 * @method static string            echo (string $message)
 * @method static mixed             ping(string $message = null)
 * @method static mixed             select(int $database)
 * @method static mixed             bgrewriteaof()
 * @method static mixed             bgsave()
 * @method static mixed             client($subcommand, $argument = null)
 * @method static mixed             config($subcommand, $argument = null)
 * @method static int               dbsize()
 * @method static mixed             flushall()
 * @method static mixed             flushdb()
 * @method static array             info($section = null)
 * @method static int               lastsave()
 * @method static mixed             save()
 * @method static mixed             slaveof(string $host, int $port)
 * @method static mixed             slowlog($subcommand, $argument = null)
 * @method static array             time()
 * @method static array             command()
 * @method static int               geoadd(string $key, $longitude, $latitude, $member)
 * @method static array             geohash(string $key, array $members)
 * @method static array             geopos(string $key, array $members)
 * @method static string|null       geodist(string $key, $member1, $member2, $unit = null)
 * @method static array             georadius(string $key, $longitude, $latitude, $radius, $unit, array $options = null)
 * @method static array             georadiusbymember(string $key, $member, $radius, $unit, array $options = null)
 * @method static array             geosearch(string $key, FromInterface $from, ByInterface $by, ?string $sorting = null, int $count = -1, bool $any = false, bool $withCoord = false, bool $withDist = false, bool $withHash = false)
 * @method static int               geosearchstore(string $destination, string $source, FromInterface $from, ByInterface $by, ?string $sorting = null, int $count = -1, bool $any = false, bool $storeDist = false)
 */
class RedisHelper
{
    /**
     * redis实例
     * @var Client
     */
    protected static $instance = null;

    /**
     * 创建连接实例
     * @return Client
     */
    public static function instance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new Client(Config::get('redis.params'), Config::get('redis.options'));
        }

        return static::$instance;
    }

    /**
     * 静态回调
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, array $arguments)
    {
        return static::instance()->{$name}(...$arguments);
    }
}