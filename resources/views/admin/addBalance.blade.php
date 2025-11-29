<p>Balance: {{ auth()->user()->balance }}</p>
@if(session('success'))
    <p class="text-green-600">{{ session('success') }}</p>
@endif
