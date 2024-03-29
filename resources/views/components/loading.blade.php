<svg
    {{ $attributes }}
    class="h-8 w-8"
    fill="none"
    viewBox="0 0 24 24"
>
    <g
        fill="none"
        stroke-linecap="round"
        stroke-width="2"
        stroke="currentColor"
    >
        <path
            d="M12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3Z"
            stroke-dasharray="60"
            stroke-dashoffset="60"
            stroke-opacity=".3"
        >
            <animate
                attributeName="stroke-dashoffset"
                dur="1.3s"
                fill="freeze"
                values="60;0"
            />
        </path>
        <path
            d="M12 3C16.9706 3 21 7.02944 21 12"
            stroke-dasharray="15"
            stroke-dashoffset="15"
        >
            <animate
                attributeName="stroke-dashoffset"
                dur="0.3s"
                fill="freeze"
                values="15;0"
            />
            <animateTransform
                attributeName="transform"
                dur="1.5s"
                repeatCount="indefinite"
                type="rotate"
                values="0 12 12;360 12 12"
            />
        </path>
    </g>
</svg>
