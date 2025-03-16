<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * class Base
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @package App\Models
 */
abstract class Base extends Model
{
    protected $fillable = [];
    protected $guarded  = [];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
