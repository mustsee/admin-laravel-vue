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
                            v-model="monument.default_name"
                            :rules="[v => !!v || 'Default name is required']"
                            label="Default name"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="monument.longitude"
                            :rules="[v => !!v || 'Longitude is required']"
                            label="Longitude"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="monument.latitude"
                            :rules="[v => !!v || 'Longitude is required']"
                            label="Latitude"
                            required
                    ></v-text-field>
                    <v-btn
                           dark
                           class="my-2"
                           color="amber"
                           @click="validate"
                    >
                        {{ editButtonText }}
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
            monument: {
                default_name: '',
                longitude: '',
                latitude: '',
            },
        }),
        computed: {
            editButtonText() {
                return this.monument.id ? 'Update' : 'Create';
            }
        },
        methods: {
            validate() {
                if (this.$refs.form.validate()) {
                    let payload = this.monument;
                    axios.post('api/monuments', {
                        payload
                    }).then((res) => {
                        GStore.setSnackbar({text: res.data.message, success: true});
                        GStore.setShowSnackbar(true);
                        this.$router.push('/monuments');
                    }).catch((err) => {
                        GStore.setSnackbar({text: err.message, success: false});
                        GStore.setShowSnackbar(true);
                    });
                }
            },
            reset() {
                this.$refs.form.reset()
            },
        },
        mounted() {
            const {id} = this.$route.params;
            if (id) {
                axios.get(`api/monuments/${id}`).then(res => {
                    this.monument = res.data;
                });
            }
        }
    }
</script>