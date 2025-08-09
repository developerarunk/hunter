<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'company_website',
        'description',
        'is_badged',
        'profile_picture_uri',
        'countries',
        'industries',
        'focus_areas',
        'facebook_platforms',
        'language_tags',
        'service_models',
        'solution_types',
        'solution_subtypes',
        'diverse_owned_identities',
    ];

    protected $casts = [
        'countries' => 'array',
        'industries' => 'array',
        'focus_areas' => 'array',
        'facebook_platforms' => 'array',
        'language_tags' => 'array',
        'service_models' => 'array',
        'solution_types' => 'array',
        'solution_subtypes' => 'array',
        'diverse_owned_identities' => 'array',
        'is_badged' => 'boolean',
    ];
}
