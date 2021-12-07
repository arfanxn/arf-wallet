class Laravel {
    static CSRF() {
        return document.querySelector(`meta[name="csrf-token"]`).content;
    }

    static toDateTimeString(dateTime) {
        return dateTime.replace(/[T]/, " ").replace(/[.].*/g, "");
    }
}
