<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateTaskMutation extends Mutation
{
    protected $attributes = [
        "name" => "updateTask",
    ];
    public function type(): Type
    {
        return GraphQL::type("Task");
    }
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('TaskStatusEnum'),
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $task = Task::findOrFail($args["id"]);
        $task->fill($args);
        $task->save();
        return $task;
    }
}
