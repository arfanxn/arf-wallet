class SearchWallet {
    // constructor () {

    // }

    setKeyword(address) {
        this.keyword = address;
        return this;
    }

    async fetch() {
        const address = this.keyword;
        try {
            let response = await fetch("/fe-api/wallet/search-by-address", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "search-wallet": address,
                })
            })

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            this.wallets = await response.json();

            // .then(res => res.json())
            // .then(wallets => {
            //     this.wallets = wallets;
            //     console.log(wallets);
            //     return wallets;
            // }).catch(err => console.log(err));
        } catch (err) {
            console.log(err);
        }
        console.log(this.wallets);
        return this;
    }

    print(wallets = null) {
        wallets = this.wallets;

        let searchWalletResultsWrapper = document.getElementById("search-wallet-results-wrapper");
        searchWalletResultsWrapper.classList.add("mb-2")

        searchWalletResultsWrapper.innerHTML = `<h6 class="fw-bold my-0 py-0">Hasil pencarian</h6>`;

        if (wallets.length > 0) {
            let index = 0;
            wallets.forEach(wallet => {
                searchWalletResultsWrapper.innerHTML += `<a href="/transaction/send-money/to/${wallet.encrypted_address}"
                    class="d-flex justify-content-between py-3 ${index < 1 ? "" : " border-bottom"} border-secondary  text-decoration-none text-dark align-middle">
                    <div><img class="rounded-circle border border-white border-2" src="/accounts/profile_picture/arfan.jpg" width="50" height="50">
                        <span class="my-auto ">${wallet.owner["name"]}</span>
                    </div>
                    <span class="my-auto me-1">${wallet.address}</span>
                </a>`
                index++;
            });
        } else {
            searchWalletResultsWrapper.innerHTML += `<p class='text-center'>Wallet Tidak Ditemukan<p>`;
        }

        return this;
    }

    static deletePrinted() {
        let searchWalletResultsWrapper = document.getElementById("search-wallet-results-wrapper");
        searchWalletResultsWrapper.classList.remove("mb-2")
        searchWalletResultsWrapper.innerHTML = "";
    }

    static whenKeywordLengthIs() {
        return 12;
    }
}

let inputSearchWallet = document.getElementsByName("search-wallet")[0];
if (inputSearchWallet.value.length >= SearchWallet.whenKeywordLengthIs()) {
    (new SearchWallet).setKeyword(inputSearchWallet.value)
        .fetch().then(srchwlt => srchwlt.print());
}

inputSearchWallet.addEventListener("input", () => {
    let value = inputSearchWallet.value;
    inputSearchWallet.value = value.toUpperCase().replace(/[^A-Z0-9_+=]/ig, "")
        .replace(/[-_=+]/g, "");
    console.log(value);
    if (value.length >= SearchWallet.whenKeywordLengthIs()) {
        (new SearchWallet).setKeyword(value).fetch().then(srchwlt => srchwlt.print());
    } else {
        SearchWallet.deletePrinted();
    }
})
