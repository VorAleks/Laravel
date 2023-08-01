<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\Source;
use App\Queries\QueryBuilder;
use App\Queries\SourcesQueryBuilder;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;



class ParserController extends Controller
{
    protected QueryBuilder $sourcesQueryBuilder;

    public function __construct(
        SourcesQueryBuilder $sourcesQueryBuilder
    )
    {
        $this->sourcesQueryBuilder = $sourcesQueryBuilder;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Parser $parser, string $source): string
    {
        $start = date('c');
        switch ($source) {
            case 'rambler':
                $urls = $this->sourcesQueryBuilder->getAll();
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
                        'uses' => 'channel.item[title,author,description,category]'
                    ]
                ];
            break;
            case 'cbrPress':
                $urls = ['https://www.cbr.ru/rss/RssPress'];
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
                        'uses' => 'channel.item[title,link,author,description,pubDate]'
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

        foreach ($urls as $urlItem) {

            if($urlItem instanceof Source) {
                $url = $urlItem->url;
            } else {
                $url = $urlItem;
            }

            dispatch(new NewsParsingJob($url, $map));
        }

        return "Data saved" . $start . ' ' . date('c');
    }
}
