<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">To-Do List</h1>
        
        <form action="/add" method="POST" class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="task" placeholder="Task name" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="urgency" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
                <input type="date" name="due_date" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="mt-4 w-full bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Add Task
            </button>
        </form>
        
        <div class="space-y-4">
            @foreach ($tasks as $task)
                <div class="p-6 bg-gray-50 rounded-lg shadow-md flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">{{ $task->task }}</h2>
                        <p class="text-gray-500">Urgency: <span class="font-bold">{{ ucfirst($task->urgency) }}</span></p>
                        <p class="text-gray-500">Due: {{ $task->due_date }}</p>
                    </div>
                    <div class="relative">
                        <button onclick="toggleDropdown({{ $task->id }})" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                            Options
                        </button>
                        <div id="dropdown-{{ $task->id }}" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg py-2">
                            <a href="{{ url('/edit/' . $task->id) }}" class="block w-full text-left text-blue-600 hover:text-blue-800 px-4 py-2">
                                Edit
                            </a>

                            <form action="/delete/{{ $task->id }}" method="POST" class="px-4 py-2" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="block w-full text-left text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
            document.getElementById(`dropdown-${id}`).classList.toggle('hidden');
        }
    </script>
</body>
</html>
