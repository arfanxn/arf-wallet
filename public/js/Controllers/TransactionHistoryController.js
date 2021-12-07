class TransactionHistoryController {
    constructor() {
        if (TransactionHistoryController._instance)
            return TransactionHistoryController._instance
        TransactionHistoryController._instance = this;

        this.transactionWrapper = document.querySelector("#transactionListsWrapper");
        this.transactions = document.querySelectorAll(".transaction");
        this.authWalletID = 1;
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
        // console.log(transactions);
        // transactions.forEach(elem => {
        //     console.log(elem);
        // });
        // return;
        this.transactionWrapper.innerHTML = "";

        // let html = `<div class="py-5 my-5 w-100" style="height : 700px"></div>`;
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
