<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex>
                <div class="text-xs-right mb-4">
                    <v-btn dark color="pink" to="/monuments/edit">
                        <v-icon dark>add</v-icon>
                    </v-btn>
                </div>
                <v-data-table
                        :headers="headers"
                        :items="monuments"
                        class="elevation-1"
                        :rows-per-page-items="rowsPerPageItems"
                        :pagination.sync="pagination"
                >
                    <template v-slot:items="props">
                        <td class="text-xs-left">{{ props.item.id }}</td>
                        <td class="text-xs-left">{{ props.item.default_name }}</td>
                        <td class="text-xs-left">{{ props.item.longitude }}</td>
                        <td class="text-xs-left">{{ props.item.latitude }}</td>
                        <td class="text-xs-left">{{ props.item.created_at }}</td>
                        <td class="text-xs-left">
                            <v-icon small @click="updateMonument(props.item.id)">
                                edit
                            </v-icon>
                            <v-icon small @click="deleteMonument(props.item.id)">
                                delete
                            </v-icon>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-container></template>

<script>
    export default {
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
                    { text: 'Default name', value: 'default_name' },
                    { text: 'Longitude', value: 'longitude' },
                    { text: 'Latitude', value: 'latitude' },
                    { text: 'Creation date', value: 'created_at' },
                    { text: 'Actions', value: 'default_name', sortable: false },
                ],
                monuments: []
            }
        },
        methods: {
            getMonuments() {
                axios.get('api/monuments').then(res => {
                    this.monuments = res.data;
                });
            },
            updateMonument(id) {
                this.$router.push(`/monuments/${id}/edit`);
            },
            deleteMonument(id) {
                axios.delete(`api/monuments/${id}`).then(() => {
                    this.getMonuments();
                });
            }
        },
        mounted() {
            this.getMonuments();
        }
    }
</script>