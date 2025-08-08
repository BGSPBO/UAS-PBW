<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Tugas</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Daftar Tugas</h2>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Batas Waktu</th>
                <th>Prioritas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($task->priority) }}</td>
                <td>{{ ucfirst($task->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
