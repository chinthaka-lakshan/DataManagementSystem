@props(['href', 'active' => false, 'icon', 'label'])

<a href="{{ $href }}" 
    {{ $attributes->merge(['class' => 'flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all duration-200 group ' . 
    ($active 
        ? 'bg-brand-50 text-brand-600 shadow-sm shadow-brand-50' 
        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900')]) }}>
    
    <div class="flex-shrink-0 transition-colors duration-200 {{ $active ? 'text-brand-600' : 'text-gray-400 group-hover:text-gray-600' }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
        </svg>
    </div>
    
    <span class="truncate transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 invisible w-0'">
        {{ $label }}
    </span>

    @if($active)
        <div class="ml-auto w-1.5 h-1.5 bg-brand-600 rounded-full" :class="sidebarOpen ? 'opacity-100' : 'opacity-0'"></div>
    @endif
</a>
