class Laravel {
    static CSRF() {
        return document.querySelector(`meta[name="csrf-token"]`).content;
    }

    static async formValidator(inputObject, URLToRequestValidate, fetchOptionOrCallback = null, callback = null) {
        try {
            let fetchOption;
            if (typeof fetchOptionOrCallback == "object") {
                fetchOption = fetchOptionOrCallback;
            } else fetchOption = null

            let response = await fetch(URLToRequestValidate, !fetchOption ? {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify(inputObject)
            } : fetchOption);

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            if (typeof fetchOptionOrCallback == "function" || typeof callback == "function") {
                callback = callback ? callback : fetchOptionOrCallback;
                return await callback(response);
            }

            let jsonObj = await response.json();

            return jsonObj;
        } catch (err) {
            console.log(err);
        }
    }

    static toDateTimeString(dateTime) {
        return (new Date(dateTime)).toLocaleString("en-UK", {
            year: "numeric",
            month: "short",
            day: '2-digit',
            hour: "2-digit",
            minute: "2-digit",
            timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone
        });
    }
}
