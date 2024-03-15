import { gql } from "@apollo/client/core";

// Create a new task mutation
export const CREATE_TASK_MUTATION = gql`
  mutation CreateTask($name: String!, $description: String!, $status: TaskStatusEnum!) {
    createTask(name: $name, description: $description, status: $status) {
      id
      name
      description
      status
    }
  }
`;

// Update an existing task mutation
export const UPDATE_TASK_MUTATION = gql`
  mutation UpdateTask($id: Int!, $name: String, $description: String, $status: TaskStatusEnum) {
    updateTask(id: $id, name: $name, description: $description, status: $status) {
      id
      name
      description
      status
    }
  }
`;

// Delete a task mutation
export const DELETE_TASK_MUTATION = gql`
  mutation DeleteTask($id: Int!) {
    deleteTask(id: $id)
  }
`;
