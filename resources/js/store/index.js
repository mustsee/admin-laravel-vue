class GramStore {
    constructor() {
        this.state = {
            showSnackbar: false,
            snackbar: {
                text: '',
                success: false,
            }
        }
    }

    setShowSnackbar(value) {
        this.state.showSnackbar = value;
    }

    setSnackbar(value) {
        this.state.snackbar = value;
    }
}

let GramStoreInstance = new GramStore();

export default GramStoreInstance;