<x-profile :sharedData="$sharedData" doctitle="{{ $sharedData['username'] }}'s following users">
  @include('profile-following-only')
</x-profile>
