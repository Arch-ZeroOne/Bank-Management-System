<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="flex justify-center w-full mt-5 flex-col items-center">
    <x-addbtn/>

    <table class="" id="myTable" class="display text-white">
    </table>

    </div>

</x-app-layout>
