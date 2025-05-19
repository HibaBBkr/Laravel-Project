<?php

namespace App\Models; // Or your application's model namespace

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel expects "cities" by default.
     *
     * @var string
     */
    protected $table = 'Cities';

    /**
     * The primary key associated with the table.
     * Laravel expects "id" by default.
     *
     * @var string
     */
    protected $primaryKey = 'city_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     * Set to true if 'city_id' is an AUTO_INCREMENT column in your database.
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
        'city_id',    // Include if you are setting it manually during creation
        'city_name',
        'State',      // This is the foreign key column name
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'city_id' => 'integer',
        'State' => 'integer',
        'city_name' => 'string',
    ];

    /**
     * Get the state that this city belongs to.
     *
     * This assumes:
     * 1. You have a `State` model (e.g., `App\Models\State`).
     * 2. The `States` table (or whatever table `State` model uses) has a primary key `state_id`.
     * 3. The foreign key in the `Cities` table is `State` (as defined in your schema).
     */
    public function stateBelongsTo(): BelongsTo
    {
        // return $this->belongsTo(State::class, 'foreign_key_on_cities_table', 'owner_key_on_states_table');
        return $this->belongsTo(State::class, 'State', 'state_id');
    }

    // If you want to access the related state using $city->state property
    // you can define the relationship method name without "BelongsTo" suffix.
    // public function state(): BelongsTo
    // {
    //     return $this->belongsTo(State::class, 'State', 'state_id');
    // }

}