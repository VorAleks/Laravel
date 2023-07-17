<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\NewsStatus;
use Illuminate\Validation\Rules\Enum;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'title' => ['required', 'string', 'min:7', 'max:200'],
            'author' => ['nullable', 'string', 'min:2', 'max:50'],
            'image' => ['sometimes'],
            'status' => ['required', new Enum(NewsStatus::class)],
            'description' => ['nullable', 'string', 'max:3000'],
            'sources' => ['nullable|array'],
            'sources.*' => ['exists:sources,id'],
        ];
    }

    public function getCategories(): array
    {
        return $this->validated('categories');
    }

    public function getSources(): array
    {
        return $this->validated('sources');
    }

    public function attributes(): array
    {
        return [
            'categories' => 'Категория',
            'title' => 'Наименование',
            'author' => 'Автор',
            'image' => 'Изображение',
            'status' => 'Статус',
            'description' => 'Описание',
            'sources' => 'Источник новости',
        ];
    }
}
