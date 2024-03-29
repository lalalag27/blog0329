<div>
    <nav x-data="{ openMenu: false }" class="flex items-center">
        <!-- 漢堡 -->
        <button type="button" @click="openMenu = !openMenu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- 標題 -->
        <div class="flex items-center px-2 text-xs font-bold shrink-0">
            <a href="{{ route('dashboard') }}"
                class="box-border transition-all border border-transparent hover:px-2 hover:rounded hover:border-black">
                {{ config('app.name', '鬼谷') }} - 網頁系統管理
            </a>
            <h1 class="before:px-2">
                {{ $title }}
            </h1>
        </div>

        <!--下拉選單 展開選單 -->
        <div x-show="openMenu" class="fixed inset-0 z-50 backdrop-blur" x-cloak>
            <!-- 遮罩 -->
            <div x-on:click="openMenu = false" class="absolute inset-0 opacity-75 bg-zinc-800"></div>
            <!-- 主體 -->
            <div class="fixed w-full h-screen max-w-xs p-10 overflow-y-auto bg-white dark:bg-zinc-900">
                <div class=mb-10>
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out border border-transparent rounded-md bg-amber-400 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                            {{ Auth::user()->currentTeam->name }}
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="relative text-zinc-900">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-amber-400 bg-amber-400">
                                        <img class="object-cover w-8 h-8 rounded-full"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center p-3 text-sm font-medium leading-4 transition duration-150 ease-in-out border border-transparent rounded-md bg-amber-400 focus:outline-none focus:bg-amber-200 active:bg-amber-50">
                                            {{ Auth::user()->email }}
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('帳戶管理') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('個人資料') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('登出') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <!-- 選單列表 -->
                @foreach ($menu as $item)
                    @if ($item['routeName'] != 'profile.show' && $item['showMenu'] == true)
                        <div class="py-4">
                            <x-nav-link href="{{ route($item['routeName']) }}" :active="$currentRouteName == $item['routeName']">
                                {{ $item['title'] }}
                            </x-nav-link>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </nav>
</div>
