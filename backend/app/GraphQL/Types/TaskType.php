<?php

namespace App\GraphQL\Types;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A Task description',
        'status' => 'A Task status',
        'model' => Task::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the Task',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Task',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of the Task',
            ],
            'status' => [
                'type' => Type::nonNull(GraphQL::type('TaskStatusEnum')),
                'description' => 'The status of the Task',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The creation date of the Task',
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The last update date of the Task',
            ],
        ];
    }
}
