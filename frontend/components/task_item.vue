<template>
    <div class="flex flex-row gap-5 justify-between">
        <button v-if="task.status === 'TODO'" class="w-12 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600" title="Mark as Done" @click="markAsDone">
            <font-awesome-icon icon="fa-solid fa-check" />
        </button>
        <button v-if="task.status === 'DONE'" class="w-12 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:bg-red-600" title="Mark as Todo" @click="markAsTodo">
            <font-awesome-icon icon="fa-solid fa-close" />
        </button>
        <div class="grid w-[70%] cursor-pointer" @click="setSelectedTask(task)">
            <p class="text-lg font-semibold">{{ task.name }}</p>
            <p class="text-sm text-gray-500">{{ task.description }}</p>
        </div>
        <button class="w-12 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:bg-red-600" title="Delete" @click="deleteTask">
            <font-awesome-icon icon="fa-solid fa-trash" />
        </button>
    </div>
</template>
  
<script lang="ts" setup>
    import { defineProps } from 'vue'; 
    import { DELETE_TASK_MUTATION, UPDATE_TASK_MUTATION } from '~/graphql/mutations/task';
    import type { Task } from '~/types/task';
    
    interface Props {
        task: Task;  
        refetch: () => void;
        setSelectedTask: (task: Task | null) => void;
    }  
    
    const props = withDefaults(defineProps<Props>(), {
        isOpen: false, 
        refetch: () => {},  
        setSelectedTask: () => {}
    })

    const updateVariables = { id: "", status: "" }; 
    
    const updateTaskMutation = useMutation(UPDATE_TASK_MUTATION, { variables: updateVariables });

    const markAsDone = () => {  
        updateVariables.id = props.task.id || '';
        updateVariables.status = "DONE";
        updateTaskMutation.mutate().then(() => props.refetch()) 
    }

    const markAsTodo = () => { 
        updateVariables.id = props.task.id || '';
        updateVariables.status = "TODO";
        updateTaskMutation.mutate().then(() => props.refetch())
    }

    const deleteVariables = { id: "", status: "" }; 
    
    const deleteTaskMutation = useMutation(DELETE_TASK_MUTATION, { variables: deleteVariables });

    const deleteTask = () => { 
        deleteVariables.id = props.task.id || ''; 
        deleteTaskMutation.mutate().then(() => props.refetch())
    }
 
</script>