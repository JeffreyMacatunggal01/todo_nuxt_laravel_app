<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
      <div class="bg-white rounded-lg p-6 min-w-[500px]">
        <h2 class="text-lg font-semibold mb-4">Add Task</h2>
        <form @submit.prevent="createTask">
          <div class="mb-4">
            <label for="taskName" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="taskName" v-model="name" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
          </div>
          <div class="mb-4">
            <label for="taskDescription" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="taskDescription" v-model="description" rows="3" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
          </div>
          <div class="mb-4">
            <label for="taskStatus" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="taskStatus" v-model="status" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option :value="TaskStatusEnum.TODO">TODO</option> 
              <option :value="TaskStatusEnum.DONE">DONE</option> 
            </select>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="setOpenAddModal(false)" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              Cancel
            </button>
            <button type="submit" class="ml-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script lang="ts" setup>
    import { ref } from 'vue';
    import TaskStatusEnum from '~/enums/TaskStatusEnum'; 
    import { useMutation } from '@vue/apollo-composable';
    import { CREATE_TASK_MUTATION } from '~/graphql/mutations/task';
    
    interface Props {
        isOpen: boolean;
        setOpenAddModal: (value: boolean) => void;
        refetch: () => void;
    } 
    
    const props = withDefaults(defineProps<Props>(), {
        isOpen: false,
        setOpenAddModal: () => {},
        refetch: () => {}
    })

    const name = ref('');
    const description = ref('');
    const status = ref('todo');

    
    const variables = { name: "", description: "", status: "" }; 
    
    const createTaskMutation = useMutation(CREATE_TASK_MUTATION, { variables });

    
    const createTask = () => {
        variables.name = name.value;
        variables.description = description.value;
        variables.status = status.value; 
        createTaskMutation.mutate().then(() => {
            props.refetch();
            props.setOpenAddModal(false);
        });
    };
  
  </script>
  