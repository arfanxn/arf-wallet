class LoadIncomeAndExpenseThisMonth {
    async load() {
        try {
            let response = await fetch(
                "/fe-api/account/load-income-and-expense-this-month-from-auth-wallet", {
                    method: "post",
                    credentials: "same-origin",
                    headers: {
                        'Content-Type': 'application/json',
                        "Accept": 'application/json',
                        "X-CSRF-Token": Laravel.CSRF()
                    },
                });

            if (!response.ok) throw new Error(`Http error -> status: ${response.status}`)

            const jsonObj = await response.json();

            this.loadedIncomeAndExpense = jsonObj;

            return this;
        } catch (err) {
            console.log(err);
        }
    }

    print() {
        const loadedIncomeAndExpense = this.loadedIncomeAndExpense;

        if (loadedIncomeAndExpense.hasOwnProperty("income")) {
            const income = loadedIncomeAndExpense.income;
            document.getElementById("incomeTotal").innerHTML = toIDR(income);
        }
        if (loadedIncomeAndExpense.hasOwnProperty("expense")) {
            const expense = loadedIncomeAndExpense.expense;
            document.getElementById("expenseTotal").innerHTML = toIDR(expense);
        }

        return this;
    }
}

(new LoadIncomeAndExpenseThisMonth).load().then(clas => clas.print());
