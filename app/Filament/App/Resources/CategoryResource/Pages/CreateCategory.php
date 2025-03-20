<?php

namespace App\Filament\App\Resources\CategoryResource\Pages;

use App\Filament\App\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $data['created_by'] = auth()->id();
        return static::getModel()::create($data);
    }
}
