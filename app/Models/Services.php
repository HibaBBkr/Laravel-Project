<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'service_id'; // Matches your schema

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hall_id',
        'service_name',
        'service_description',
        'service_price',
        'price_type', // 'fixed' or 'person'
        'picture_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'service_price' => 'decimal:2',
    ];

    /**
     * Get the hall that offers this service.
     */
    public function hall()
    {
        // Foreign key 'hall_id' on 'services' table, owner key 'hall_id' on 'halls' table
        return $this->belongsTo(Hall::class, 'hall_id', 'hall_id');
    }
}