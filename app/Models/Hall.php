<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'hall_id'; // Matches your schema

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'hall_name',
        'hall_description',
        'city_id',
        'capacity',
        'base_price',
        'map_url',
        'host_rules',
        'host_contact_name',
        'host_contact_email',
        'host_contact_phone',
        'host_rip',
        'cardholder_name',      // Be extremely cautious with card data
        'card_number_last4',    // Be extremely cautious with card data
        'terms_accepted',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'base_price' => 'decimal:2',
        'terms_accepted' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get the owner (user) of the hall.
     */
    public function owner()
    {
        // Foreign key 'owner_id' on 'halls' table, owner key 'id' on 'users' table
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the city where the hall is located.
     */
    public function city()
    {
        // Foreign key 'city_id' on 'halls' table, owner key 'city_id' on 'cities' table
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    /**
     * Get the pictures for the hall.
     */
    public function pictures()
    {
        // Foreign key 'hall_id' on 'hall_pictures' table, local key 'hall_id' on 'halls' table
        return $this->hasMany(HallPicture::class, 'hall_id', 'hall_id');
    }

    /**
     * Get the services offered by the hall.
     */
    public function services()
    {
        // Foreign key 'hall_id' on 'services' table, local key 'hall_id' on 'halls' table
        return $this->hasMany(Service::class, 'hall_id', 'hall_id');
    }

    /**
     * The hall types that belong to the hall.
     */
    public function hallTypes()
    {
        return $this->belongsToMany(
            HallTypeAvailable::class,
            'hall_hall_type_available', // Pivot table name
            'hall_id',                  // Foreign key on pivot for Hall
            'hall_type_id'              // Foreign key on pivot for HallTypeAvailable
        );
        // Add ->withTimestamps(); if your pivot table has created_at/updated_at
    }
}