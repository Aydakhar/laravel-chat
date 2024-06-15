<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="user-container">
        <div class="row">
            <div class="list" id="list">
                @foreach($users as $user)
                    <a class="list-item" href="{{ route('chat', $user) }}">
                        <div class="list-item__avatar">
                            <img src="/images/default-avatar.jpg" />
                        </div>
                        <div class="list-item__content">
                            <strong class="list-item__name">{{ $user->name }}</strong>
                            <span class="list-item__info">
                                    <br>
                                    {{ $user->email }}
                                </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
