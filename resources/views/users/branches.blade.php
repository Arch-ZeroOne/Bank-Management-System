<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loan Requests') }}
        </h2>
    </x-slot>
    <x-header location="Branches" />
    <div class="flex justify-center w-full">
        <table class="" id="branchesTable" class="display text-white w-full">

        </table>
    </div>
</x-app-layout>
