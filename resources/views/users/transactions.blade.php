<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="flex justify-center w-full">
        <table class="" id="transactionTable" class="display text-white w-full">

        </table>
    </div>
</x-app-layout>
