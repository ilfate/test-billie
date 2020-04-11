<?php declare(strict_types=1);

namespace marsTime\Config;

class DataConfig implements IConfig
{
    /**
     * @inheritDoc
     */
    public function getLeapSeconds(): int
    {
        return 37;
    }
}