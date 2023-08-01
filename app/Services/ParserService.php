<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Enums\NewsStatus;
use App\Models\News;
use App\Models\Source;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
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
        $data = $xml->parse($this->map);

        // проверяем источник в БД. Если нет такого названия - создаем
        $validator = Validator::make($data, [
            'title' => 'required|unique:sources,title|max:250',
        ]);
        if ($validator->passes()) {
            Source::create(['title' => $data['title'], 'url' => $this->link]);
        }
        // Получаем ID источника
        $source = DB::table('sources')->where('title', '=', $data['title'])->value('id');
        foreach ($data['news'] as $newsItem) {
            // проверяем категорию в БД. Если нет такой категории - создаем
            $validator = Validator::make($newsItem, [
                'category' => 'required|unique:categories,title|max:250',
            ]);
            if ($validator->passes()) {
                Category::create(['title' => $newsItem['category'], 'description' => $data['description']]);
            }
            // Получаем ID категории
            $category = DB::table('categories')->where('title', '=', $newsItem['category'])->value('id');
            $newsItem['source'] = $source;
            $newsItem['category'] = $category;
            $newsItem['status'] = NewsStatus::ACTIVE->value;
            $validator = Validator::make($newsItem, [
                'category' => 'required',
                'title' => 'required|string|min:7|max:255|unique:news,title',
                'author' => 'nullable|string|min:2|max:50',
                'image' => 'sometimes',
                'status' => ['required', new Enum(NewsStatus::class)],
                'description' => 'nullable|string|max:3000',
                'source' => 'required',
            ]);

            if ($validator->passes()) {
                $validated = $validator->validated();
                $news = News::create($validated);
                if ($news) {
                    $news->sources()->attach($source);
                    $news->categories()->attach($category);
                }
            }
        }



        // something more
//        $explode = explode('/', $this->link);
//        $filename = end($explode);
//        Storage::append('parse/' . $filename . ".txt", json_encode($data));
    }
}

