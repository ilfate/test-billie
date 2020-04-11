<?php
declare(strict_types=1);

namespace marsTime\Entity;

class JulianDate
{
    /** @var float */
    private $date;

    public function __construct(float $date)
    {
        $this->date = $date;
    }

    public function __toString()
    {
        return (string) $this->date;
    }

    public function add(JulianDate $time): JulianDate
    {
        $date = $time->getDate() + $this->date;
        return new static($date);
    }

    /**
     * @return float
     */
    public function getDate()
    {
        return $this->date;
    }
}