<?php

declare(strict_types=1);

namespace wfm;

class Cache
{
    use TSingleton;
    public function set(string $key, mixed $data, int $seconds = 3600): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        $file = sprintf('%s/%s.txt', CACHE, md5($key));

        if (!is_dir(CACHE)) {
            mkdir(CACHE, recursive: true);
        }

        if (false !== file_put_contents($file, serialize($content))) {
            return true;
        }
        return false;
    }

    public function get(string $key): mixed
    {
        $file = sprintf('%s/%s.txt', CACHE, md5($key));
        if (is_file($file)) {
            $serialize_content = file_get_contents($file);
            $content = unserialize($serialize_content);
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function delete(string $key): void
    {
        $file = sprintf('%s/%s.txt', CACHE, md5($key));
        if (is_file($file)) {
            unlink($file);
        }
    }
}
