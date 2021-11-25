<x-app-layout title="Detail Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-slot name="styles">
        <style>
            .invoice-wrapper {
                position: absolute;
                z-index: 99999;
            }

        </style>
    </x-slot>

    <x-transaction-header route="{{ route('transaction.history') }}">
        Detail Transaksi
    </x-transaction-header>

    <div class="invoice-wrapper bg-warning p-5 -50 "></div>



</x-app-layout>
