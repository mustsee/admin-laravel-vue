<template>
    <v-snackbar
            v-model="state.showSnackbar"
            :timeout="timeout"
            right
            top
    >
        {{ state.snackbar.text }}
        <v-btn
                :color="state.snackbar.success ? 'success' : 'error'"
                flat
                @click="handleCloseSnack"
        >
            Close
        </v-btn>
    </v-snackbar>
</template>
<script>
    import GStore from './../../store';

    export default {
        data() {
            return {
                state: GStore.state,
                timeout: 2000,
            }
        },
        methods: {
            handleCloseSnack() {
                GStore.setShowSnackbar(false);
            }
        }
    }
</script>