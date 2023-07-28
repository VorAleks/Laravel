<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\Parser;
use JetBrains\PhpStorm\NoReturn;
use Orchestra\Parser\Xml\Facade;

class ParserService implements Parser
{
    private string $link;
    private array $map;

    public function setLink(string $link): Parser
    {
        $this->link = $link;

        return $this;
    }

    public function setMap(array $map): Parser
    {
        $this->map = $map;

        return $this;
    }

    #[NoReturn] public function saveParseData(): void
    {
        $xml = Facade::load($this->link);
//        dd($xml);
        $data = $xml->parse($this->map);
        dd($data);
        // something more
    }
}
