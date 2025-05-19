<?php

namespace App\Models; // Or your application's model namespace

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel expects "states" by default.
     *
     * @var string
     */
    protected $table = 'States';

    /**
     * The primary key associated with the table.
     * Laravel expects "id" by default.
     *
     * @var string
     */
    protected $primaryKey = 'state_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     * Set to true if 'state_id' is an AUTO_INCREMENT column in your database.
     * Based on your INSERT statements, it seems you are managing IDs manually.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     * Laravel expects created_at and updated_at columns by default.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'state_id', // Include because $incrementing is likely false
        'Code',
        'state_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'state_id' => 'integer',
        'Code' => 'integer',
        'state_name' => 'string',
    ];

    /**
     * Get the cities for the state.
     *
     * This assumes:
     * 1. You have a `City` model (e.g., `App\Models\City`).
     * 2. The `Cities` table has a foreign key named `State` (as per your City model's FK)
     *    referencing `States.state_id`.
     */
    public function cities(): HasMany
    {
        // return $this->hasMany(RelatedModel::class, 'foreign_key_on_related_table', 'local_key_on_this_table');
        return $this->hasMany(City::class, 'State', 'state_id');
    }
}