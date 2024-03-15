import { gql } from "@apollo/client/core";
import TaskStatusEnum from "~/enums/TaskStatusEnum";

export const GET_TASKS = gql`
  query tasks($status: TaskStatusEnum) {
    tasks(status: $status) {
      created_at
      id
      updated_at
      status
      name
      description
    }
  }
`;
