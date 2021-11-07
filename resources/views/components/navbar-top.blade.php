<nav class="bg-primary fixed-top  offset-md-4 col-12 col-md-4 p-1">
    <x-icon.wallet></x-icon.wallet>
    <div class="d-inline pe-2">
        <small class="align-top d-inline">Rp</small>
        <p class="d-inline align-baseline">200.000</p>
    </div>
    <img class="btnModal" data-modal-name="wallet-info" width="14px" height="14px"
        src="{{ asset('icon/caret-dropdown.png') }}" alt="">
    <x-modal.wallet-info></x-modal.wallet-info>

    <a href="" class="float-end">
        <x-icon.inbox></x-icon.inbox>
    </a>
</nav>
<div class="p-3 w-100"></div>
