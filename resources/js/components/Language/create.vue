<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex xs8 md6 lg4 class="mt-4">
                <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                >
                    <v-text-field
                            class="my-2"
                            v-model="code"
                            :counter="10"
                            :rules="codeRules"
                            label="Code"
                            required
                    ></v-text-field>
                    <v-btn
                            dark
                            class="my-2"
                            color="green"
                            @click="validate"
                    >
                        Create
                    </v-btn>
                    <v-btn
                            class="my-2"
                            color="error"
                            @click="reset"
                    >
                        Reset Form
                    </v-btn>
                </v-form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import GStore from './../../store';

    export default {
        data: () => ({
            valid: true,
            code: '',
            codeRules: [
                v => !!v || 'Code is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters'
            ],
        }),
        methods: {
            validate () {
                if (this.$refs.form.validate()) {
                    const payload = {
                        code: this.code,
                    };
                    axios.post('api/languages', {
                        payload
                    }).then((res) => {
                        GStore.setSnackbar({text: res.data.message, success: true});
                        GStore.setShowSnackbar(true);
                        this.$router.push('/languages');
                    }).catch(err => {
                        GStore.setSnackbar({text: err.message, success: false});
                        GStore.setShowSnackbar(true);
                    });
                }
            },
            reset () {
                this.$refs.form.reset()
            },
        }
    }
</script>