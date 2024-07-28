<?php

namespace Dipesh79\LaravelHelpers\Tests\Models;

use Dipesh79\LaravelHelpers\Tests\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Dipesh79\LaravelHelpers\Traits\Filterable;

    protected $guarded = [];

    protected array $filterable = ['name'];

    protected static function factory(int $count = 1): Factory
    {
        if ($count && $count > 1) {
            return UserFactory::times($count);
        } else {
            return UserFactory::new();
        }
    }

    public function getFilterableColumns(): array
    {
        return $this->filterable;
    }

    public function setFilterableColumns(array $columns): void
    {
        $this->filterable = $columns;
    }
}
