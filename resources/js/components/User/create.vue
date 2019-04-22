<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex xs12 md8 lg6 class="mt-4">
                <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                >
                    <v-text-field
                            class="my-2"
                            v-model="name"
                            :counter="20"
                            :rules="nameRules"
                            label="Name"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="email"
                            :rules="emailRules"
                            label="E-mail"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="password"
                            :counter="20"
                            :rules="passwordRules"
                            label="Password"
                            required
                    ></v-text-field>
                    <v-btn
                            dark
                            class="my-2"
                            color="amber"
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
    </v-container></template>

<script>
    import GStore from './../../store';
    import { cacheName, usersAPI } from './../../helpers';

    export default {
        data: () => ({
            valid: true,
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 20) || 'Name must be less than 20 characters'
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            password: '',
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length >= 8) || 'Password must have at least 8 characters'
            ]
        }),

        methods: {
            validate () {
                if (this.$refs.form.validate()) {
                    const payload = {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                    };
                    axios.post(usersAPI, {
                        payload
                    }).then((res) => {
                        caches.open(cacheName).then(cache => cache.delete(usersAPI));
                        GStore.setSnackbar({text: res.data.message, success: true});
                        GStore.setShowSnackbar(true);
                        this.$router.push('/users');
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