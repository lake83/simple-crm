<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;

class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function booted()
    {
        static::deleting(function ($company) {
            $path = storage_path('app/public/companies/' . $company->logo);

            if (File::exists($path)) {
                File::delete($path);
            }
        });
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class, 'company_id');
    }

    public static function getAll()
    {
        return static::select('id', 'name as text')->get();
    }
}
