<x-frontLayout>

<div class="shadow p-4 d-flex justify-content-between align-items-center">
    <h1 class="text-uppercase">Welcome, {{ auth('front-user')->user()->name }}</h1>
    
</div>
    <div class="justify-content-between my-5 py-5 items-center">
        <h4>You are Login...</h4>
        <form method="POST" action="{{ route('EMlogout') }}">
            @csrf
            <div class="flex items-center  mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Logout') }}
                </x-primary-button>
            </div>
            {{-- <button type="submit">Logout</button> --}}
        </form>
    </div>
</x-frontLayout>