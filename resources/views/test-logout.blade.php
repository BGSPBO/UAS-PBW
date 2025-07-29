<!DOCTYPE html>
<html>
<head>
    <title>Test Logout</title>
</head>
<body>
    <h1>Test Manual Logout</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
