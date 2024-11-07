<x-mail::message>
# Note Action Taken

Action Taken: {{ $action }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
