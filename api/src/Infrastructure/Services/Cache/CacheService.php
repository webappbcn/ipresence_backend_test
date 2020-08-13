<?php

namespace App\Infrastructure\Services\Cache;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;

/**
 * Class CacheService.
 */
class CacheService
{
    /**
     * @var AdapterInterface
     */
    private $cache;

    /**
     * CacheService constructor.
     */
    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param        $value
     * @param string $ttl
     *
     * @return bool
     *
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function set(string $key, $value, string $ttl = null): bool
    {
        $expiry = $ttl ? new \DateTime($ttl) : new \DateTime('+12 months');
        $data = [
            'item' => $value,
            'expiry' => $expiry->getTimestamp(),
        ];

        $item = $this->cache->getItem($key);
        $item->set($data);

        return $this->cache->save($item);
    }

    /**
     * @return array|null
     *
     * @throws InvalidArgumentException
     */
    public function get(string $key): ?array
    {
        $item = $this->cache->getItem($key);

        $response = null;
        if ($item->isHit()) {
            $response = $item->get();
        }

        return $response;
    }

    /**
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function del(string $key): bool
    {
        return $this->cache->deleteItem($key);
    }

    /**
     * @return bool
     */
    public function isExpired(array $response): bool
    {
        $now = new \DateTime();

        return isset($response['expiry']) && $response['expiry'] <= $now->getTimestamp();
    }
}
