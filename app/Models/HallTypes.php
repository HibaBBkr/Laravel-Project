<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallTypes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Define if class name doesn't match table name convention (e.g., HallType -> hall_types).
     *
     * @var string
     */
    protected $table = 'hall_types_available'; // Matches your schema

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'hall_type_id'; // Matches your schema

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // As per common practice for lookup tables

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_name',
    ];

    /**
     * The halls that have this type.
     */
    public function halls()
    {
        return $this->belongsToMany(
            Hall::class,
            'hall_hall_type_available', // Pivot table name
            'hall_type_id',             // Foreign key on pivot for HallType
            'hall_id'                   // Foreign key on pivot for Hall
        );
        // Add ->withTimestamps(); if your pivot table has created_at/updated_at
    }
}