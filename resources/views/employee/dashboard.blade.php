<x-frontLayout>
<h1>Welcome, {{ auth('front-user')->user()->name }}</h1>
<form method="POST" action="{{ route('EMlogout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</x-frontLayout>