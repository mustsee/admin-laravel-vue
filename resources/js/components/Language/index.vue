<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex>
                <div class="text-xs-right mb-4">
                    <v-btn dark color="green" to="/languages/create">
                        <v-icon dark>add</v-icon>
                    </v-btn>
                </div>
                <v-data-table
                        :headers="headers"
                        :items="languages"
                        class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td class="text-xs-left">{{ props.item.id }}</td>
                        <td class="text-xs-left">{{ props.item.code }}</td>
                        <td class="text-xs-left">{{ props.item.created_at }}</td>
                        <td class="text-xs-left">
                            <modal :id="props.item.id"
                                   :itemValue="props.item.code.toUpperCase()"
                                   itemName="language"
                                   action="delete"
                                   @delete="removeLanguage"
                            >
                            </modal>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Modal from '../elements/modal';

    export default {
        components: {
            'modal': Modal,
        },
        data () {
            return {
                headers: [
                    {
                        text: 'ID',
                        align: 'left',
                        value: 'id'
                    },
                    { text: 'Code', value: 'code' },
                    { text: 'Creation date', value: 'created_at' },
                    { text: 'Actions', value: 'name', sortable: false },
                ],
                languages: [],
            }
        },
        methods: {
            getLanguages() {
                axios.get('api/languages').then(res => {
                    this.languages = res.data;
                });
            },
            removeLanguage(id) {
                axios.delete(`api/languages/${id}`).then(() => {
                    this.getLanguages();
                });
            }
        },
        mounted() {
            this.getLanguages();
        }
    }
</script>