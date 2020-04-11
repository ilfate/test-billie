<?php
declare(strict_types=1);


namespace marsTime\Application;


class HeaderSetter
{
    public function setHeader($header)
    {
        header($header);
    }
}