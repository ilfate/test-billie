<?php declare(strict_types=1);

namespace marsTime\Config;

interface IConfig
{
    /**
     * @return int
     */
    public function getLeapSeconds(): int;
}