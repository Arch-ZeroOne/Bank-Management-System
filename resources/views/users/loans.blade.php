<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Loans') }}
        </h2>
    </x-slot>
    <x-header location="Loans" />
    <div class="flex justify-center w-full mt-5 ">
        <table class="" id="loansTable" class="display text-white">

        </table>
    </div>
</x-app-layout>
