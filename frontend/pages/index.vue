<template>
   
  <ClientOnly>
    <div class="bg-gray-100 h-screen flex justify-center items-center">
      <div class="w-full max-w-lg relative">
        <div class="flex bg-white border-b-2 shadow"> 
          <button class="w-1/2 px-4 py-2 focus:outline-none text-lg font-bold" @click="handleTabClick(TaskStatusEnum.TODO)">
            Todo ({{ taskTodo.length }})
          </button> 
          <div class="border-x-2"></div> 
          <button class="w-1/2 px-4 py-2 focus:outline-none text-lg font-bold" @click="handleTabClick(TaskStatusEnum.DONE)">
            Done ({{ taskDone.length }})
          </button> 
        </div>
        <div class="bg-white p-4 shadow h-80 relative flex flex-col gap-5 overflow-y-scroll">
          <template v-if="taskTodo.length > 0 && tabState === TaskStatusEnum.TODO">
              <TaskItem v-for="task in taskTodo" :key="task.id" :task="task" :refetch="refetch" :setSelectedTask="setSelectedTask" />
          </template>
          <template v-else-if="taskDone.length > 0 && tabState === TaskStatusEnum.DONE">
            <TaskItem v-for="task in taskDone" :key="task.id" :task="task" :refetch="refetch" :setSelectedTask="setSelectedTask" />
          </template>
          <template v-else>
            <div class="text-gray-500 text-center">
              <span>No tasks found.</span>
            </div>
          </template> 
        </div>
        <button class="absolute bottom-4 right-4 bg-blue-500 hover:bg-blue-600 text-white h-10 w-10 rounded-full shadow" tooltip="Create Task" @click="add">  
            <font-awesome-icon icon="fa-solid fa-plus" /> 
        </button> 
      </div>
    </div>
    <AddTaskModal :isOpen='isAddModalOpen' :refetch="refetch" :setOpenAddModal="setAddModalOpen"/>
    <UpdateTaskModal :isOpen='selectedTask !== null' :refetch="refetch" :task="selectedTask" :setSelectedTask="setSelectedTask"/> 
  </ClientOnly>
</template> 

<script lang="ts" setup>
  import { GET_TASKS } from '@/graphql/queries/task';   
  import TaskStatusEnum from '~/enums/TaskStatusEnum'; 
  import type { Task, TaskResult } from '~/types/task';

  const tabState = ref<TaskStatusEnum>(TaskStatusEnum.TODO);
  const isAddModalOpen = ref<boolean>(false); 
  const selectedTask = ref<Task | null>(null);
 
  const variables = {status : null}; 
  const { result, error, refetch, onResult } = useQuery<TaskResult>(GET_TASKS, variables);  

  const taskTodo = ref<Task[]>([]);
  const taskDone = ref<Task[]>([]);

  onResult(() => { 
    const tasks = result.value?.tasks ?? [];  
    taskTodo.value = tasks.filter((task) => task.status === TaskStatusEnum.TODO);
    taskDone.value = tasks.filter((task) => task.status === TaskStatusEnum.DONE);
  }); 

  const handleTabClick = (status: TaskStatusEnum) => {
    tabState.value = status; 
  }  
 
  const setAddModalOpen = (val: boolean) => {    
    isAddModalOpen.value = val; 
    
    if(!val){ 
      refetch();
    }
  }

  const setSelectedTask = (task: Task | null) => {  
    console.log(task, 'task');
      
    selectedTask.value = task;
  }

  const add = () => {    
    setAddModalOpen(true); 
  }

  

    
  
 
</script>
 
 