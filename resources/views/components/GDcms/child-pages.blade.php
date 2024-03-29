@props([
    'childPages' => [],
    'currentRouteName' => '',
])

<div class="flex space-x-10">
    @foreach ($childPages as $childPage)
        <x-nav-link :href="route($childPage['routeName'])" :active="$currentRouteName == $childPage['routeName']">
            {{ __($childPage['name']) }}
        </x-nav-link>
    @endforeach
</div>
