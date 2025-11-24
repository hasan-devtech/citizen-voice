<?php

namespace App\Traits;

trait Translatable
{
    public function getTranslated($model, string $field, string $lang)
    {
        $column = "{$field}_{$lang}";
        if (isset($model->{$column}) && $model->{$column} !== null) {
            return $model->{$column};
        }
        $fallback = "{$field}_en";
        return $model->{$fallback} ?? null;
    }
}
