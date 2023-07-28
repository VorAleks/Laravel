<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;



class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Parser $parser, string $source): string
    {
        switch ($source) {
            case 'rambler':
                $url = 'https://news.rambler.ru/rss/tech/';
                $map = [
                    'title' => [
                        'uses' => 'channel.title',
                    ],
                    'link' => [
                        'uses' => 'channel.link',
                    ],
                    'description' => [
                        'uses' => 'channel.description',
                    ],
                    'image' => [
                        'uses' => 'channel.image.url',
                    ],
                    'news'=> [
                        'uses' => 'channel.item[title,link,author,description,pubDate,category]'
                    ]
                ];
            break;
            case 'cbrPress':
                $url = 'https://www.cbr.ru/rss/RssPress';
                $map = [
                    'title' => [
                        'uses' => 'channel.title',
                    ],
                    'link' => [
                        'uses' => 'channel.link',
                    ],
                    'description' => [
                        'uses' => 'channel.description',
                    ],
                    'image' => [
                        'uses' => 'channel.image.url',
                    ],
                    'news'=> [
                        'uses' => 'channel.item[title,link,author,description,pubDate,category]'
                    ]
                ];
                break;
            case 'cbrCurrency':
                $url = 'https://www.cbr-xml-daily.ru/daily.xml';
                $map = [
                    'currencies' => [
                        'uses' => 'Valute[NumCode,CharCode,Nominal,Name,Value]',
                    ],
                          ];
            break;

        }


        $parser->setLink($url)->setMap($map)->saveParseData();

        return "Data saved";
    }
}
