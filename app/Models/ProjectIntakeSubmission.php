<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectIntakeSubmission extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'project_summary',
        'locale',
        'selected_modules',
        'estimate_score',
        'estimate_size',
        'budget_tier',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'selected_modules' => 'array',
            'estimate_score' => 'integer',
        ];
    }
}
