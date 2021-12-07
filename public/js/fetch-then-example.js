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
