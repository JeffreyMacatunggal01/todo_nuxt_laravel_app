<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTask'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string())
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::nonNull(GraphQL::type('TaskStatusEnum')),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $task = new Task();
        $task->name = $args['name'];
        $task->description = $args['description'];
        $task->status = $args['status'];
        $task->save();

        return $task;
    }
}
