<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex>
                <v-data-table
                        :headers="headers"
                        :items="monumentTranslations"
                        class="elevation-1"
                        :rows-per-page-items="rowsPerPageItems"
                        :pagination.sync="pagination"
                >
                    <template v-slot:items="props">
                        <td class="text-xs-left">{{ props.item.id }}</td>
                        <td class="text-xs-left">{{ props.item.monument_id }}</td>
                        <td class="text-xs-left">{{ props.item.language.code }}</td>
                        <td class="text-xs-left">{{ props.item.name }}</td>
                        <td class="text-xs-left">{{ props.item.city }}</td>
                        <td class="text-xs-left">{{ props.item.country }}</td>
                        <td class="text-xs-left">{{ props.item.created_at }}</td>
                        <td class="text-xs-left">
                            <v-icon small @click="updateMonumentTranslation(props.item)">
                                edit
                            </v-icon>
                            <modal :id="props.item.id"
                                   :itemValue="props.item.name"
                                   itemName="translation of"
                                   action="delete"
                                   @delete="deleteMonumentTranslation"
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
    import Modal from './../../elements/modal';

    export default {
        components: {
            'modal': Modal,
        },
        data () {
            return {
                rowsPerPageItems: [5, 10, 15, 25, 50],
                pagination: {
                    rowsPerPage: 10
                },
                headers: [
                    {
                        text: 'ID',
                        align: 'left',
                        value: 'id'
                    },
                    {
                        text: 'Monument id',
                        align: 'left',
                        value: 'monument_id'
                    },
                    { text: 'Language', value: 'language.code' },
                    { text: 'Name', value: 'name' },
                    { text: 'City', value: 'city' },
                    { text: 'Country', value: 'country' },
                    { text: 'Creation date', value: 'created_at' },
                    { text: 'Actions', sortable: false },
                ],
                monumentTranslations: []
            }
        },
        methods: {
            getMonumentTranslations() {
                axios.get('api/monuments/translations').then(res => {
                    this.monumentTranslations = res.data;
                });
            },
            updateMonumentTranslation(item) {
                this.$router.push(`/monuments/${item.monument_id}/translations/${item.id}/edit`);
            },
            deleteMonumentTranslation(id) {
                axios.delete(`api/monuments/translations/${id}`).then(() => {
                    this.getMonumentTranslations();
                });
            },
        },
        mounted() {
            this.getMonumentTranslations();
        }
    }
</script>