class TransactionHistoryController {
    constructor() {
        if (TransactionHistoryController._instance)
            return TransactionHistoryController._instance
        TransactionHistoryController._instance = this;

        this.filterDate = "all";
        this.filterType = "all";

        this.transactionWrapper = document.querySelector("#transactionListsWrapper");
        this.transactions = document.querySelectorAll(".transaction");
        this.authWalletID = this.transactionWrapper.getAttribute('data-authWallet')
    }

    sortByOldest() {
        let reversed = [];
        for (let i = this.transactions.length; i > 0; i--) {
            reversed.push(this.transactions[i - 1]);
        }
        this.print(reversed);
        return this;
    }

    sortByNewest() {
        this.print(this.transactions);
        return this;
    }

    print(transactions) {
        // transactions = transactions ? transactions : this.transactions;

        this.transactionWrapper.innerHTML = "";

        transactions.forEach(elem => {
            let transactionData = JSON.parse(elem.getAttribute("data-transaction"));
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

    dateThisMonthAndTypeSendMoney() {
        return this;
    }
}



console.log((new TransactionHistoryController) == (new TransactionHistoryController));


let radioBtnSorting = document.getElementsByName("transactions-sorting");
radioBtnSorting.forEach((elem) => {
    let isChecked = elem.checked;
    if (isChecked && elem.value == "oldest") {
        (new TransactionHistoryController).sortByOldest();
    }

    elem.addEventListener("change", () => {
        if (elem.value == "oldest") return (new TransactionHistoryController)
            .sortByOldest();
        if (elem.value == "newest") return (new TransactionHistoryController)
            .sortByNewest();
    })
});



const modalTransactionFilter = document.getElementById("modalTransactionFilter");
const btnCloseModalTransactionFilter = document.getElementById("btnCloseModalTransactionFilter");
btnCloseModalTransactionFilter.addEventListener("click", () => {
    modalTransactionFilter.classList.add("d-none");
});

const btnShowFilteredTransactions = document.getElementById("btnShowFilteredTransactions");
btnShowFilteredTransactions.addEventListener("click", () => {

    let filterSettings = {
        "type": "",
        "date": "",
    };

    let transactionsFilterDate = document.getElementsByName('transactions-filter-date');
    transactionsFilterDate.forEach(elem => {
        if (elem.checked) {
            filterSettings["date"] = elem.value;
        }
    });

    let transactionsFilterType = document.getElementsByName('transactions-filter-type');
    transactionsFilterType.forEach(elem => {
        if (elem.checked) {
            filterSettings["type"] = elem.value;
        }
    });

    if (filterSettings['date'] == 'this-month' && filterSettings["type"] == "send-money") {
        (new TransactionHistoryController).dateThisMonthAndTypeSendMoney();
    }



    modalTransactionFilter.classList.add("d-none");
});
