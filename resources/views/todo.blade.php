<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="tasks flex flex-col gap-3 mb-12">
                        <form class="edit flex items-end gap-3" action="{{ route('search') }}" method="post">
                            @csrf
                            @method('post')
                            <x-text-input type="text" name="search" style="max-height: 34px;" />
                            <x-primary-button type="submit">Find</x-primary-button>
                        </form>
                        <h1 class="text-2xl">Task List</h1>
                        @foreach($tasks as $task)
                            <ul class="list-decimal task-{{ $task->status }}">
                                <li class="flex  task-line justify-between items-end">
                                    <p class="text-xl">{{ $task->title }}</p>
                                    <div class="flex gap-3 action items-end">
                                        <form class="edit flex items-end gap-3" action="{{ route('task.edit', $task) }}"
                                            method="post">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="status" value="complete" hidden>
                                            <x-primary-button type="submit">Complete</x-primary-button>
                                        </form>
                                        <form class="edit flex items-end gap-3" action="{{ route('task.edit', $task) }}"
                                            method="post">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="status" value="failed" hidden>
                                            <x-primary-button type="submit">Fail</x-primary-button>
                                        </form>
                                        <form class="edit flex items-end gap-3" action="{{ route('task.edit', $task) }}"
                                            method="post">
                                            @csrf
                                            @method('patch')
                                            <x-text-input type="text" name="title" style="max-height: 34px;" />
                                            <x-primary-button type="submit">Edit</x-primary-button>
                                        </form>
                                        <form action="{{ route('task.delete', $task) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button type="submit" class="ms-3">Delete</x-danger-button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        {{ $tasks->links() }}
                    </div>

                    <form action="{{ route('task.create') }}" method="POST">
                        @csrf
                        <div class="max-w-80 flex flex-col gap-2">
                            <x-input-label for="title" value="Task Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required
                                autofocus />
                            <x-primary-button>Add new task</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>