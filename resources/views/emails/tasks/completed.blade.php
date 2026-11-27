<x-mail::message>
# Task completed

The task **{{ $task->title }}** has been marked as done.

@if ($task->description)
{{ $task->description }}
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
