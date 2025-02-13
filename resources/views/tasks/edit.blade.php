<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Edit Task</h2>
        <form action="{{ url('/update/' . $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block text-gray-700">Task Name</label>
            <input type="text" name="task" value="{{ $task->task }}" class="w-full border p-2 rounded-lg mb-4">

            <label class="block text-gray-700">Urgency</label>
            <select name="urgency" class="w-full border p-2 rounded-lg mb-4">
                <option value="low" {{ $task->urgency == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->urgency == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->urgency == 'high' ? 'selected' : '' }}>High</option>
            </select>

            <label class="block text-gray-700">Due Date</label>
            <input type="date" name="due_date" value="{{ $task->due_date }}" class="w-full border p-2 rounded-lg mb-4">

            <div class="flex justify-end">
                <a href="/" class="bg-gray-400 text-white px-4 py-2 rounded-lg mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update Task</button>
            </div>
        </form>
    </div>
</body>
</html>