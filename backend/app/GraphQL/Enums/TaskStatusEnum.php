<?php

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class TaskStatusEnum extends EnumType
{
    protected $attributes = [
        'name' => 'TaskStatusEnum',
        'description' => 'The types of task status',
        'values' => [
            'TODO' => 'TODO',
            'DONE' => 'DONE'
        ],
    ];
}
