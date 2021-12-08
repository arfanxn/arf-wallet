<div {{ $attributes->merge(['class' => 'd-none']) }} id="modalTransactionFilter">
    <x-modal._modal-background>
        <div class="mt-auto col-md-4 col-12 bg-white px-2">

            <div class="d-flex justify-content-between py-2">
                <h5 class="fw-bold">Filter</h5>

                <button id="btnCloseModalTransactionFilter" class="btn btn-danger py-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-lg " viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                        <path fill-rule="evenodd"
                            d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                    </svg><span class="ms-1">Batal</span>
                </button>
            </div>

            <div class="d-flex mb-2">

                <div class="">
                    <small class="d-block fw-light">Pilih jarak waktu untuk ditampilkan</small>
                    <div class="row p-0 m-0 row-cols-4 justify-content-start">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date" value="all"
                                checked id="radiofilterShowAll">
                            <label class="form-check-label" for="radiofilterShowAll">Semua</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date" value="today"
                                id="radiofilterToday">
                            <label class="form-check-label" for="radiofilterToday">Hari Ini</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date"
                                value="this-week" id="radiofilterWeek">
                            <label class="form-check-label" for="radiofilterWeek">Minggu Ini</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date"
                                value="this-month" id="radiofilterMonth">
                            <label class="form-check-label" for="radiofilterMonth">Bulan Ini</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date"
                                value="range-3-month" id="radiofilter3MonthAgo">
                            <label class="form-check-label" for="radiofilter3MonthAgo">3 Bulan Ini</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-date"
                                value="this-year" id="radiofilterYear">
                            <label class="form-check-label" for="radiofilterYear">Tahun ini</label>
                        </div>
                    </div>

                    <small class="d-block fw-light mt-3">Pilih Jenis Transaksi</small>
                    <div class="row p-0 m-0 row-cols-4 justify-content-start">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-type" value="all"
                                checked checked id="radiofilterTransactionShowAll">
                            <label class="form-check-label" for="radiofilterTransactionShowAll">Semua</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-type"
                                value="send-money" id="radiofilterTransactionSendMoney">
                            <label class="form-check-label" for="radiofilterTransactionSendMoney">Kirim Uang</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transactions-filter-type"
                                value="receive-money" id="radiofilterTransactionReceiveMoney">
                            <label class="form-check-label" for="radiofilterTransactionReceiveMoney">Terima Uang</label>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-auto">
                    <button id="btnShowFilteredTransactions" class="btn btn-success py-0 d-flex m-0"><svg
                            xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-check my-auto" viewBox="0 0 16 16">
                            <path
                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg><span class="ms-1">Tampilkan</span>
                    </button>
                </div>
            </div>


        </div>
    </x-modal._modal-background>
</div>
