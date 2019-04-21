<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex xs12 md8 lg6 class="mt-4">
                <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                >
                    <v-select
                            v-model="translation.language_id"
                            :items="languages"
                            item-text="code"
                            item-value="id"
                            :rules="[v => !!v || 'Language is required']"
                            label="Language"
                            required
                    ></v-select>
                    <v-text-field
                            class="my-2"
                            v-model="translation.name"
                            :rules="[v => !!v || 'Name is required']"
                            label="Name"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="translation.city"
                            :rules="[v => !!v || 'City is required']"
                            label="City"
                            required
                    ></v-text-field>
                    <v-text-field
                            class="my-2"
                            v-model="translation.country"
                            :rules="[v => !!v || 'Country is required']"
                            label="Country"
                            required
                    ></v-text-field>
                    <v-textarea
                            auto-grow
                            rows="3"
                            class="my-2"
                            v-model="translation.content"
                            :rules="[v => !!v || 'Content is required']"
                            label="Content"
                            required
                    ></v-textarea>
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
    import GStore from './../../../store';

    export default {
        data: () => ({
            valid: true,
            languages: [],
            translation: {
                monument_id: '',
                language_id: '',
                name: '',
                city: '',
                country: '',
                content: ''
            },
        }),
        computed: {
            editButtonText() {
                return this.translation.id ? 'Update' : 'Create';
            }
        },
        methods: {
            validate() {
                if (this.$refs.form.validate()) {
                    let payload = this.translation;
                    axios.post('api/monuments/translations', {
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
            const { monument_id, translation_id} = this.$route.params;
            if (!monument_id) return this.$router.push('/monuments');
            else {
                this.translation.monument_id = monument_id;
                axios.get('api/languages').then(res => {
                    this.languages = res.data;
                });
                if (translation_id) {
                    axios.get(`api/monuments/translations/${translation_id}`).then(res => {
                        this.translation = res.data;
                    });
                }
            }
        }
    }
</script>