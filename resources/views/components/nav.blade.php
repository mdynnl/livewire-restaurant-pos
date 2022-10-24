<nav
    {{ $attributes }}
    class="sticky top-0 flex items-center px-4 bg-white border-b shadow-md"
>
    <div @class([
        'flex py-2 border-b-2',
        Route::is('home')
            ? 'pointer-events-none border-black'
            : 'border-transparent',
    ])>
        <a
            class="px-3 py-1 text-sm rounded-lg hover:bg-gray-200"
            href="{{ route('home') }}"
        >
            Tables
        </a>
    </div>

    <div @class([
        'flex py-2 border-b-2',
        Route::is('orders') || Route::is('table-orders')
            ? 'pointer-events-none border-black'
            : 'border-transparent',
    ])>
        <a
            class="px-3 py-1 text-sm rounded-lg hover:bg-gray-200"
            href="{{ route('orders') }}"
        >
            Orders
        </a>
    </div>

    <form
        action="{{ route('logout') }}"
        class="flex py-2 ml-auto"
        method="POST"
    >
        @csrf
        <button class="px-3 py-1 text-sm rounded-lg hover:bg-gray-200">
            {{ __('Logout') }}
        </button>
    </form>
</nav>
