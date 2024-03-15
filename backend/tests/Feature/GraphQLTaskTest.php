<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GraphQLTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a simple GraphQL query.
     *
     * @return void
     */

    public function testGraphQLQuery()
    {
        // Replace this with the actual GraphQL query you want to test
        $query = '
            query {
                tasks(status: TODO) {
                    id
                    name
                    description
                    status
                }
            }
        ';

        // Send a POST request to the GraphQL endpoint with the query
        $response = $this->postJson('/graphql', ['query' => $query]);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert the structure of the response
        $response->assertJsonStructure([
            'data' => [
                'tasks' => [
                    '*' => ['id', 'name', "description", "status"]
                ]
            ]
        ]);
    }

    /**
     * Test creating a new task using GraphQL mutation.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $mutation = '
            mutation CreateTask($name: String!, $description: String!, $status: TaskStatusEnum!) {
                createTask(
                    name: $name,
                    description: $description,
                    status: $status
                ) {
                    id
                    name
                    description
                    status
                } 
            }
        ';

        $variables = [
            'name' => 'Task 1',
            'description' => 'This task has been created',
            'status' => 'TODO'
        ];

        $response = $this->postJson('/graphql', ['query' => $mutation, 'variables' => $variables]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'createTask' => ['id', 'name', 'description', 'status']
            ]
        ]);
    }

    /**
     * Test updating an existing task using GraphQL mutation.
     *
     * @return void
     */
    public function testUpdateTask()
    {
        // Create a task to update
        $mutation = '
            mutation CreateTask($name: String!, $description: String!, $status: TaskStatusEnum!) {
                createTask(
                    name: $name,
                    description: $description,
                    status: $status
                ) {
                    id
                    name
                    description
                    status
                } 
            }
        ';

        $variables = [
            'name' => 'Task 1',
            'description' => 'This task has been created',
            'status' => 'TODO'
        ];

        $response = $this->postJson('/graphql', ['query' => $mutation, 'variables' => $variables]);

        // Update the task

        $mutation = '
            mutation UpdateTask($id: Int!, $name: String!, $description: String!, $status: TaskStatusEnum!) {
                updateTask(
                    id: $id, 
                    name: $name,
                    description: $description,
                    status: $status
                ) {
                    id
                    name
                    description
                    status
                }
            }
        ';

        $updatedVariables = [
            "id" => $response->json()['data']['createTask']['id'],
            'name' => 'Task 1 Updated',
            'description' => 'This task has been updated',
            'status' => 'DONE'
        ];

        $updateResponse = $this->postJson('/graphql', ['query' => $mutation, 'variables' => $updatedVariables]);

        $updateResponse->assertStatus(200);

        $updateResponse->assertJsonStructure([
            'data' => [
                'updateTask' => ['id', 'name', 'description', 'status']
            ]
        ]);
    }

    /**
     * Test deleting a task using GraphQL mutation.
     *
     * @return void
     */
    public function testDeleteTask()
    {
        // Create a task to delete
        $mutation = '
            mutation CreateTask($name: String!, $description: String!, $status: TaskStatusEnum!) {
                createTask(
                    name: $name,
                    description: $description,
                    status: $status
                ) {
                    id
                    name
                    description
                    status
                } 
            }
        ';

        $variables = [
            'name' => 'Task 1',
            'description' => 'This task has been created',
            'status' => 'TODO'
        ];

        $response = $this->postJson('/graphql', ['query' => $mutation, 'variables' => $variables]);

        // Delete the task
        $mutation = '
            mutation UpdateTask($id: Int!) {
                deleteTask(id: $id)
            }
        ';

        $updateVariables = [
            "id" => $response->json()['data']['createTask']['id'],
        ];

        $response = $this->postJson('/graphql', ['query' => $mutation, "variables" => $updateVariables]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'deleteTask' => true
            ]
        ]);
    }
}
