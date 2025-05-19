<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallPicture extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'picture_id'; // Matches your schema

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hall_id',
        'image_path',
        'alt_text',
    ];

    /**
     * Get the hall that owns the picture.
     */
    public function hall()
    {
        // Foreign key 'hall_id' on 'hall_pictures' table, owner key 'hall_id' on 'halls' table
        return $this->belongsTo(Hall::class, 'hall_id', 'hall_id');
    }
}