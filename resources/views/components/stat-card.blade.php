<div class="relative bg-gray-900 rounded-lg p-4 
    {{ $color === 'blue' ? 'border-blue-500/50 shadow-blue-500/30 hover:shadow-blue-500/50' : '' }}
    {{ $color === 'green' ? 'border-green-500/50 shadow-green-500/30 hover:shadow-green-500/50' : '' }}
    {{ $color === 'purple' ? 'border-purple-500/50 shadow-purple-500/30 hover:shadow-purple-500/50' : '' }}
    border 
    shadow-lg
    transition duration-300 
    hover:scale-105
    overflow-hidden">
    <div class="absolute -inset-px 
        {{ $color === 'blue' ? 'bg-blue-500/20' : '' }}
        {{ $color === 'green' ? 'bg-green-500/20' : '' }}
        {{ $color === 'purple' ? 'bg-purple-500/20' : '' }}
        blur-2xl animate-pulse"></div>
    <div class="relative z-10">
        <div class="text-2xl font-bold 
            {{ $color === 'blue' ? 'text-blue-300 drop-shadow-[0_0_5px_rgba(59,130,246,0.7)]' : '' }}
            {{ $color === 'green' ? 'text-green-300 drop-shadow-[0_0_5px_rgba(34,197,94,0.7)]' : '' }}
            {{ $color === 'purple' ? 'text-purple-300 drop-shadow-[0_0_5px_rgba(168,85,207,0.7)]' : '' }}">
            {{ $count }}
        </div>
        <div class="text-gray-400 text-sm">{{ $label }}</div>
    </div>
</div>