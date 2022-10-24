<div
    {{ $attributes->class(['flex items-center bg-white border border-gray-200 rounded-md']) }}
    :class="{ 'border-gray-500': focus }"
    x-data="{ focus: false }"
>
    <div class="grid h-10 w-10 place-items-center">
        <svg
            fill="#888888"
            height="18"
            viewBox="0 0 32 32"
            width="18"
            wire:loading.remove
            wire:target="search"
        >
            <path
                d="m29 27.586l-7.552-7.552a11.018 11.018 0 1 0-1.414 1.414L27.586 29ZM4 13a9 9 0 1 1 9 9a9.01 9.01 0 0 1-9-9Z"
            />
        </svg>
        <svg
            fill="none"
            height="18"
            viewBox="0 0 24 24"
            width="18"
            wire:loading
            wire:target="search"
        >
            <path
                d="M12 2A10 10 0 1 0 22 12A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8A8 8 0 0 1 12 20Z"
                opacity=".5"
            />
            <path
                d="M20 12h2A10 10 0 0 0 12 2V4A8 8 0 0 1 20 12Z"
                fill="currentColor"
            >
                <animateTransform
                    attributeName="transform"
                    dur="1s"
                    from="0 12 12"
                    repeatCount="indefinite"
                    to="360 12 12"
                    type="rotate"
                />
            </path>
        </svg>
    </div>

    <input
        @blur="focus = false"
        @focus="focus = true"
        class="flex-1 border-none bg-transparent px-0 py-2 text-sm leading-6 focus:ring-0"
        placeholder="Search..."
        type="text"
        wire:model.debounce.300ms="search"
    >

    <button
        @click="$wire.search = ''"
        class="grid h-10 w-10 place-items-center rounded-r-md border border-transparent outline-none focus-visible:border-gray-500"
        style="display: none"
        x-show="$wire.search"
    >
        <svg
            class="group-hover:fill-black"
            fill="#888888"
            height="18"
            viewBox="0 0 24 24"
            width="18"
        >
            <path
                d="M12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m2.59 6L12 10.59L9.41 8L8 9.41L10.59 12L8 14.59L9.41 16L12 13.41L14.59 16L16 14.59L13.41 12L16 9.41L14.59 8Z"
            />
        </svg>
    </button>
</div>
