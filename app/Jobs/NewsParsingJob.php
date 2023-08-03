<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\Contracts\Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $link;
    protected array $map;

    /**
     * Create a new job instance.
     */
    public function __construct(string $link, array $map)
    {
        $this->link = $link;
        $this->map = $map;
    }

    /**
     * Execute the job.
     */
    public function handle(Parser $parser): void
    {
        $parser->setLink($this->link)->setMap($this->map)->saveParseData();
    }
}
