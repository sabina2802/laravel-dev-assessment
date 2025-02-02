<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_posts'; // Using the new table name

    protected $fillable = [
        'title',
        'description',
        'experience',
        'salary',
        'location',
        'extraInfo',
        'companyName',
        'logo',
        'skills',
    ];

    protected $casts = [
        'skills' => 'array',
    ];

     // Define Many-to-Many Relationship with Skill Model
     public function skillsList()
     {
         return $this->belongsToMany(Skill::class, 'job_post_skill', 'job_post_id', 'skill_id');
     }

     public function skills()
     {
         return $this->belongsToMany(Skill::class, 'job_post_skill', 'job_post_id', 'skill_id');
     }
}
