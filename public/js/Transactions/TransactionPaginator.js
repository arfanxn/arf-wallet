class TransactionPaginator {
    constructor() {
        this.setSortBy("newest").setTransactionDate("all").setTransactionType("all")
            .setPaginationFetchURL().fetchPagination().then(tscpag => {
                tscpag.printPagination().printPaginationButton();
            });
    }

    setSortBy(string) {
        this.sortBy = string;
        return this;
    }

    setTransactionDate(string) {
        this.transactionDate = string;
        return this;
    }

    setTransactionType(string) {
        this.transactionType = string;
        return this;
    }

    setPaginationFetchURL(string = null) {
        if (string == null) {
            const transactionDate = this.hasOwnProperty("transactionDate") ? this.transactionDate : "all",
                transactionType = this.hasOwnProperty("transactionType") ? this.transactionType : "all",
                sortBy = this.hasOwnProperty("sortBy") ? this.sortBy : "desc";

            const prefix = "/fe-api";
            let stringURL = `/transaction/history/filter?transaction-type=${transactionType}&transaction-date=${transactionDate}&sortby=${sortBy}`;
            let page = `&page=1`;

            this.paginationFetchURL = prefix + stringURL + page;
        } else {
            this.paginationFetchURL = string;
        }

        return this;
    }

    async fetchPagination(url = null, callback = null) {
        if (typeof url == "function") callback = url;
        if (!url || typeof url == "function") url = this.paginationFetchURL;

        let response = await fetch(url, {
            method: "post",
            credentials: "same-origin",
            headers: {
                'Content-Type': 'application/json',
                "Accept": 'application/json',
                "X-CSRF-Token": Laravel.CSRF()
            },
        });

        try {
            if (!response.ok) {
                throw new Error(`HTTP error -> status: ${response.status}`);
            }
            callback ? callback(response) :
                this.fetchedPagination = await response.json();

        } catch (err) {
            console.log(err);
        }
        return this;
    }

    printPagination(pagination = null) {
        pagination = pagination ? pagination :
            this.fetchedPagination.data;

        let transactionPaginationWrapper = document
            .getElementById("transaction-pagination-wrapper");
        transactionPaginationWrapper.innerHTML = "";

        if (pagination.length > 0) {
            pagination.forEach(transactionData => {
                transactionPaginationWrapper.innerHTML += `<a href="/transaction/detail/${transactionData.tx_hash}" data-transaction="${transactionData}"
                class="transaction d-flex justify-content-between py-3 border-bottom border-secondary mx-3 text-decoration-none text-dark">
                <div class="my-auto">
                    <span class="d-block">
                        ${this.getAuthWallet("user_id") == transactionData.from_wallet_id ? 'Kirim Uang' : 'Terima Uang' }</span>
                    <small>${Laravel.toDateTimeString(transactionData.created_at)}</small>
                </div>
                <div class="my-auto">
                    <span class="align-middle">${toIDR(transactionData.amount)}</span>
                </div>
            </a>`
            });
        } else {
            transactionPaginationWrapper.innerHTML =
                `<div class="d-flex mt-4 justify-content-center badge bg-info rounded-0">
                <h1 class="text-center my-auto fw-bold">Tidak Ditemukan</h1></div>`
        }
        return this;
    }

    printPaginationButton() {
        let totalCurrentPageTransactionPagination = document.querySelector(`#totalCurrentPageTransactionPagination`);
        totalCurrentPageTransactionPagination.innerHTML = this.getPaginateCurrentPage();

        let btnWrapperTransactionPagination = document.getElementById("btnWrapperTransactionPagination");
        btnWrapperTransactionPagination.innerHTML = "";

        let htmlString = `<nav><ul id="ul-transaction-paginator" class="pagination">`;
        if (this.getPaginateCurrentPage() <= 1) {
            htmlString += `<li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Sebelumnya</span>
                </li>`
        } else {
            htmlString += `<li class="page-item">
                    <a id="paginatorTransactionPrevURL" class="page-link
                    btnPrevNextTransactionPagination" data-href="${this.getPaginatePrevURL()}"
                     href="#" rel="prev">Sebelumnya</a>
                </li>`
        }

        if (this.getPaginateNextURL()) {
            htmlString += `<li class="page-item">
                    <a id="paginatorTransactionNextURL" class="btnPrevNextTransactionPagination
                     page-link" href="#" data-href="${this.getPaginateNextURL()}" 
                        rel="next">Selanjutnya</a>
                </li>`;
        } else {
            htmlString += `<li class="page-item disabled" aria-disabled="true">
            <span class="page-link">Selanjutnya</span>
        </li>`;
        }

        htmlString += `</ul></nav>`;

        btnWrapperTransactionPagination.innerHTML = htmlString;

        this.addPaginationButtonEventListener();

        return this;
    }

    addPaginationButtonEventListener() {
        let btnPrevNextTransactionPagination = document.querySelectorAll(
            ".btnPrevNextTransactionPagination");
        btnPrevNextTransactionPagination.forEach(elem => {
            elem.addEventListener("click", () => {
                const anchorHref = elem.getAttribute("data-href");
                transactionPaginator.fetchPagination(anchorHref).then(tscpag => {
                    tscpag.printPagination().printPaginationButton();
                });
            });
        });
    }

    getAuthWallet(key = null) {
        if (this.fetchedPagination.hasOwnProperty("auth_wallet")) {
            if (typeof key == "string") {
                return this.fetchedPagination.auth_wallet.hasOwnProperty(key) ?
                    this.fetchedPagination.auth_wallet[key] : null;
            } else {
                return this.fetchedPagination.auth_wallet
            }
        } else {
            return null;
        }
    }

    getPaginateCurrentPage() { // return number of current pagination
        return parseInt(this.fetchedPagination.meta.current_page);
    }

    getPaginatePrevURL() {
        let links = this.fetchedPagination.links
        return links.hasOwnProperty("prev") ? links.prev : null;
    }

    getPaginateNextURL() {
        let links = this.fetchedPagination.links
        return links.hasOwnProperty("next") ? links.next : null;
    }
}

let transactionPaginator = (new TransactionPaginator);

const radioBtnSorting = document.getElementsByName("transactions-sorting");

const btnShowFilteredTransactions = document.getElementById("btnShowFilteredTransactions");
btnShowFilteredTransactions.addEventListener("click", () => {

    const sortBy = getCheckedRadioBtnValue(radioBtnSorting),
        transactionType = getCheckedRadioBtnValue("transactions-filter-type"),
        transactionDate = getCheckedRadioBtnValue("transactions-filter-date");

    transactionPaginator.setSortBy(sortBy).setTransactionDate(transactionDate)
        .setTransactionType(transactionType).setPaginationFetchURL()
        .fetchPagination().then(obj => obj.printPagination().printPaginationButton());

    modalTransactionFilter.classList.add("d-none");
});

// close  button -> modal-transaction-filter (HTML/CSS)
const modalTransactionFilter = document.getElementById("modalTransactionFilter");
const btnCloseModalTransactionFilter = document.getElementById("btnCloseModalTransactionFilter");
btnCloseModalTransactionFilter.addEventListener("click", () => {
    clickRadioBtnWhereValueEqualTo(radioBtnSorting, transactionPaginator.sortBy);
    clickRadioBtnWhereValueEqualTo("transactions-filter-type" /*RadioBtnElementName*/ , transactionPaginator.transactionType /*VALUE*/ );
    clickRadioBtnWhereValueEqualTo("transactions-filter-date", transactionPaginator.transactionDate);

    modalTransactionFilter.classList.add("d-none");
});

radioBtnSorting.forEach(elem => {
    elem.addEventListener("change", (e) => {
        throttleInputClick(e.target, 5000);
        const sortBy = getCheckedRadioBtnValue(radioBtnSorting),
            transactionType = getCheckedRadioBtnValue("transactions-filter-type"),
            transactionDate = getCheckedRadioBtnValue("transactions-filter-date");

        transactionPaginator.setSortBy(sortBy).setTransactionDate(transactionDate)
            .setTransactionType(transactionType).setPaginationFetchURL()
            .fetchPagination().then(tscpag => tscpag.printPagination().printPaginationButton());
    });
});
