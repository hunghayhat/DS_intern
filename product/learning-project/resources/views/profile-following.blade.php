<x-profile :sharedData="$sharedData" doctitle="{{ $sharedData['username'] }}'s following users">
    <div class="list-group">
        @foreach ($following as $follow)
            <a href="/post/{{ $follow->userBeingFollowed->username }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $follow->userBeingFollowed->avatar }}" />
                {{ $follow->userBeingFollowed->username }}
            </a>
        @endforeach
    </div>
</x-profile>
