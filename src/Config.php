<?php

namespace Application;

class Config
{
    private array $cfg;

    public function __construct()
    {
        $this->cfg = [];
    }

    public function getEnv($key): string
    {
        $this->collectEnvVars();

        return '';
    }

    public function getConfig($key): mixed
    {
        $this->gatherConfigFiles();

        return $this->cfg[$key];
    }

    public function collectEnvVars(): void
    {
        $cfg      = [];
        $envFiles = ['.env', '.env.local'];

        foreach ($envFiles as $envFile) {
            $path = sprintf('%s/%s', APPLICATION_PATH, $envFile);
            if (file_exists($path)) {
                $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $keyValuePair) {
                    [$key, $value] = explode('=', $keyValuePair);
                    $this->cfg['env'][$key] = $value;
                }
            }
        }
    }

    private function gatherConfigFiles(): void
    {
        $configPath = APPLICATION_PATH . '/config/';
        $blacklist  = ['.', '..'];
        $cfgDir     = dir($configPath);
        $config     = [];

        while (false !== ($filename = $cfgDir->read())) {
            if (!in_array($filename, $blacklist, true)) {
                $config = include $configPath . $filename;
            }
        }

        $this->cfg = array_merge($this->cfg, $config);
    }
}