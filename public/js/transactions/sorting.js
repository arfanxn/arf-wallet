let transactionListsWrapper = document.querySelector("#transactionListsWrapper");
let transactions = document.querySelectorAll(".transaction");


function sortByOldest() {
    transactionListsWrapper.innerHTML = '';
    let reversed = [];
    for (let i = transactions.length; i > 0; i--) {
        // reversed.push(transactions[i - 1])
        let transactionData = JSON.parse(transactions[i - 1].getAttribute("data-transaction"));
        let authWallet = JSON.parse(transactions[i - 1].getAttribute("data-authWallet"))

        transactionListsWrapper.innerHTML += `<a href="/transaction/detail/${transactionData.tx_hash}" data-transaction="${transactionData}"
                class="transaction d-flex justify-content-between py-3 border-bottom border-secondary mx-3 text-decoration-none text-dark">
                <div class="my-auto">
                    <span class="d-block">
                        ${authWallet.id == transactionData.from_wallet_id ? 'Kirim Uang' : 'Terima Uang' }</span>
                    <small>${transactionData.created_at}</small>
                </div>
                <div class="my-auto">
                    <span class="align-middle">${toIDR(transactionData.amount)}</span>
                </div>
            </a>`
    }
}










// let radioBtnSorting = document.getElementsByName("transactions-sorting");
// radioBtnSorting.forEach((elem) => {
//     let isChecked = elem.checked;
//     if (isChecked && elem.value == "oldest") {
//         sortByOldest();
//     }

//     elem.addEventListener("change", (obj) => {
//         const sortBy = obj.originalTarget.value;
//         // fetch(`/fe-api/transactions/sorting/${sortBy}`, {
//         //         method: "post",
//         //         credentials: "same-origin",
//         //         headers: {
//         //             'Content-Type': 'application/json',
//         //             "Accept": 'application/json',
//         //             "X-CSRF-Token": laravelCSRF()
//         //         },
//         //     })
//         //     .then((res) => res.json())
//         //     .then((res) => console.log(res))
//         //     .catch((err) => console.log(err));
//     });
// });

// async function getTransactions(sortBy) {
//     return await fetch(`/fe-api/transactions/sorting/${sortBy}`, {
//             method: "post",
//             credentials: "same-origin",
//             headers: {
//                 'Content-Type': 'application/json',
//                 "Accept": 'application/json',
//                 "X-CSRF-Token": laravelCSRF()
//             },
//         })
//         .then((res) => res.json())
//         .then((res) => console.log(res))
//         .catch((err) => console.log(err));
// }
