<h2>Google Calendar Events</h2>
<table border="1">
    <tr><th>Summary</th><th>Start</th></tr>
    @foreach ($calendar['items'] ?? [] as $event)
        <tr>
            <td>{{ $event['summary'] ?? 'N/A' }}</td>
            <td>{{ $event['start']['dateTime'] ?? $event['start']['date'] ?? 'N/A' }}</td>
        </tr>
    @endforeach
</table>

<h2>ToDos</h2>
<table border="1">
    <tr><th>Task</th><th>Status</th></tr>
    @foreach ($tasks['items'] ?? [] as $task)
        <tr>
            <td>{{ $task['title'] }}</td>
            <td>{{ $task['status'] }}</td>
        </tr>
    @endforeach
</table>

<h2>Recent Emails</h2>
<table border="1">
    <tr><th>Email ID</th></tr>
    @foreach ($emails['messages'] ?? [] as $email)
        <tr>
            <td>{{ $email['id'] }}</td>
        </tr>
    @endforeach
</table>
