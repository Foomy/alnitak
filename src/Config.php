<?php

namespace Application;

class Config
{
    private const KEY_SEPARATOR = '.';

    private array $cfg;

    public function __construct()
    {
        $this->cfg = [];
    }

    public function getEnv($key):  string
    {
        $this->collectEnvVars();
        return $this->cfg[$key];
    }

    public function getConfig(string $key): mixed
    {
        $this->gatherConfigFiles();

        if (false !== (strpos($key, self::KEY_SEPARATOR))) {
            $keys = explode(self::KEY_SEPARATOR, $key);
        }

        return $this->cfg[$key];
    }

    public function collectEnvVars(): void
    {
        $cfg = [];
        $envFiles = ['.env', '.env.local'];

        foreach ($envFiles as $envFile) {
            $path = sprintf('%s/%s', APPLICATION_PATH, $envFile);
            if (file_exists($path)) {
                $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $keyValuePair) {
                    [$key, $value] = explode('=', $keyValuePair);
                    if (! str_starts_with($key, '#')) {
                        $this->cfg[$key] = $value;
                    }
                }
            }
        }
    }

    private function gatherConfigFiles(): void
    {
        $configPath = APPLICATION_PATH . '/config/';
        $blacklist  = ['.', '..'];
        $cfgDir     = dir($configPath);
        $configs     = [];

        while (false !== ($filename = $cfgDir->read())) {
            if (!in_array($filename, $blacklist, true)) {
                $configs[] = include $configPath . $filename;
            }
        }

        $this->cfg = array_merge($this->cfg, ...$configs);
    }
}