<!-- Button trigger modal -->
<button id="triggerModalTransactionSorting" type="button" class="" data-bs-toggle="modal"
    data-bs-target="#modalTransactionSorting">
</button>

<!-- Modal -->
<div class="modal fade " id="modalTransactionSorting" tabindex="-1" aria-labelledby="modalTransactionSortingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="modalTransactionSortingLabel">Urut Berdasarkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="transactions-sorting" id="radioNewest" checked
                        value="newest">
                    <label class="form-check-label" for="radioNewest">Terbaru</label>

                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="transactions-sorting" id="radioOldest"
                        value="oldest">
                    <label class="form-check-label" for="radioOldest">Terlama</label>
                </div>
            </div>
        </div>
    </div>
</div>
