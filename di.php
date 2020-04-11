<?php
declare(strict_types=1);

return [
    \marsTime\Config\IConfig::class => DI\create(\marsTime\Config\DataConfig::class),
    \marsTime\Domain\Service\TerrestrialTimeConverterService::class => function (\Psr\Container\ContainerInterface $c) {
        return new \marsTime\Domain\Service\TerrestrialTimeConverterService(
            $c->get(\marsTime\Config\IConfig::class)->getLeapSeconds(),
            $c->get(\marsTime\Domain\Service\JulianDateConverterService::class)
        );
    },
];
