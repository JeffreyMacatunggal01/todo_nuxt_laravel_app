import type TaskStatus from "~/enums/TaskStatus";

export type Task = {
  id?: string;
  name: string;
  description: string;
  status: TaskStatus;
};

export type TaskResult = {
  tasks: Task[];
};
