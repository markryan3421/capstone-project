<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @props([
    'title' => '',     // Title of the card
    'icon' => null     // Optional icon class
    ])

    <div {{ $attributes->merge(['class' => 'bg-gray-800 rounded-xl shadow-lg p-6']) }}>
        <div class="mb-4 flex items-center space-x-2">
            @if ($icon)
                <i class="{{ $icon }} text-white text-xl"></i>
            @endif
            <h2 class="text-lg font-semibold text-white">
                {{ $title }}
            </h2>
        </div>
        
        {{-- This will render the content passed between <x-info-card>...</x-info-card> --}}
        {{ $slot }}
    </div>

</div>