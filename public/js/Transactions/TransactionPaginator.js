class TransactionPaginator {
    constructor() {
        this.transactionWrapper = document.querySelector("#transactionListsWrapper");
        this.transactions = document.querySelectorAll(".transaction");
        this.authWalletID = (this.transactionWrapper.getAttribute('data-authWallet'));
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

    setPaginateURL(string = null) {
        if (string == null) {
            const transactionDate = this.hasOwnProperty("transactionDate") ? this.transactionDate : "all",
                transactionType = this.hasOwnProperty("transactionType") ? this.transactionType : "all",
                sortBy = this.hasOwnProperty("sortBy") ? this.sortBy : "desc";

            const prefix = "/fe-api";
            let stringURL = `/transaction/history/filter?transaction-type=${transactionType}&transaction-date=${transactionDate}&sortby=${sortBy}`;

            this.fetchPaginateURL = prefix + stringURL + `&page=${this.constructor.getPaginateCurrentPage()}`;
            this.prevPaginateURL = stringURL + `&page=${
                this.constructor.getPaginateCurrentPage() <= 1 ? 1 :(this.constructor.getPaginateCurrentPage() - 1)}`;
            this.nextPaginateURL = stringURL + `&page=${
                this.constructor.getPaginateCurrentPage() + 1}`;
        } else {
            this.paginateURL = string;
        }

        return this;
    }

    async fetchPagination(url = null, callback = null) {
        if (typeof url == "function") callback = url;
        if (!url || typeof url == "function") url = this.fetchPaginateURL;

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

            console.log(this.fetchedPagination);
        } catch (err) {
            console.log(err);
        }
        // if (callback == null) {
        //     fetchedPagination.then((res) => res.json())
        //         .then(res => this.fetchedPagination = res)
        //         .then((res) => console.log(res))
        //         .catch((err) => console.log(err));
        // } else {
        //     callback(fetchedPagination);
        // }
        return this;
    }

    printPagination(pagination = null) {
        pagination = pagination ? pagination :
            this.fetchedPagination.data;

        this.transactionWrapper.innerHTML = "";

        pagination.forEach(elem => {
            let transactionData = elem;
            this.transactionWrapper.innerHTML += `<a href="/transaction/detail/${transactionData.tx_hash}" data-transaction="${transactionData}"
                class="transaction d-flex justify-content-between py-3 border-bottom border-secondary mx-3 text-decoration-none text-dark">
                <div class="my-auto">
                    <span class="d-block">
                        ${this.authWalletID == transactionData.from_wallet_id ? 'Kirim Uang' : 'Terima Uang' }</span>
                    <small>${Laravel.toDateTimeString(transactionData.created_at)}</small>
                </div>
                <div class="my-auto">
                    <span class="align-middle">${toIDR(transactionData.amount)}</span>
                </div>
            </a>`
        });

        return this;
    }

    printPaginationButton() {
        console.log(this.prevPaginateURL);
        let prevPaginateURL = document.getElementById("paginatorTransactionPrevURL");
        if (prevPaginateURL) {
            console.log(prevPaginateURL);
            prevPaginateURL.setAttribute("href", this.prevPaginateURL);
            prevPaginateURL.href = this.prevPaginateURL;
            console.log(prevPaginateURL);
        }

        let nextPaginateURL = document.getElementById("paginatorTransactionNextURL");
        if (nextPaginateURL) {
            nextPaginateURL.setAttribute("href", this.nextPaginateURL);
            nextPaginateURL.href = this.nextPaginateURL;
        }

        return this;
    }

    static getPaginateCurrentPage() { // return number of current pagination
        const transactionsPaginator = document.getElementById("transactionsPaginator");
        let currentPage = parseInt(transactionsPaginator.getAttribute("data-transaction-current-page"));
        return typeof currentPage == "number" ? currentPage : 1;
    }

    static getPaginatePrevURL() {
        const transactionsPaginator = document.getElementById("paginatorTransactionPrevURL");
        return transactionsPaginator.getAttribute("href");
    }

    static getPaginateNextURL() {
        const transactionsPaginator = document.getElementById("paginatorTransactionNextURL");
        return transactionsPaginator.getAttribute("href");
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
        .setTransactionType(transactionType).setPaginateURL()
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
    elem.addEventListener("change", () => {
        const sortBy = getCheckedRadioBtnValue(radioBtnSorting),
            transactionType = getCheckedRadioBtnValue("transactions-filter-type"),
            transactionDate = getCheckedRadioBtnValue("transactions-filter-date");

        // transactionPaginator.setSortBy(getCheckedRadioBtnValue(radioBtnSorting))
        //     .setPaginateURL().fetchPagination()
        //     .then(obj => obj.printPagination().printPaginationButton());

        transactionPaginator.setSortBy(sortBy).setTransactionDate(transactionDate)
            .setTransactionType(transactionType).setPaginateURL()
            .fetchPagination().then(obj => obj.printPagination().printPaginationButton());
    });
});
