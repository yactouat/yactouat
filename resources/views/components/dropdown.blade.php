@props(['trigger'])

<div x-data="{
    show: false
}">
    <div @click="show = ! show" @click.away="show = false">
        {{ $trigger }}
    </div>
    <!-- binding the display of the div to the `show` property -->
    <div 
        x-show="show" 
        class="py-2 absolute bg-gray-200 w-full mt-2 rounded-xl w-full text-left z-50 overflow-auto max-h-52"
        style="display: none"
    >
        {{ $slot }}
    </div>
</div>