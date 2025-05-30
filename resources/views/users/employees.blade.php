<x-app-layout>

    <x-header location="Employees" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>


    <div class="flex justify-center w-full mt-1 flex-col items-center">

        <table class="" id="employeesTable" class="display text-white mdl-data-table">

        </table>

    </div>

</x-app-layout>
