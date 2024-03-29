@if ($errors->any())
    <div class="w-full p-10 text-sm text-red-600 border border-red-600 rounded dark:bg-zinc-900 bg-zinc-100">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
