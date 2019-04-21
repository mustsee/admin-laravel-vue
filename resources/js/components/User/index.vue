<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex>
                <div class="text-xs-right mb-4">
                    <v-btn dark color="amber" to="/users/create">
                        <v-icon dark>add</v-icon>
                    </v-btn>
                </div>
                <v-data-table
                        :headers="headers"
                        :items="users"
                        class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td class="text-xs-left">{{ props.item.id }}</td>
                        <td class="text-xs-left">{{ props.item.name }}</td>
                        <td class="text-xs-left">{{ props.item.email }}</td>
                        <td class="text-xs-left">{{ props.item.created_at }}</td>
                        <td class="text-xs-left">
                            <modal :id="props.item.id"
                                   :itemValue="props.item.email"
                                   itemName="user"
                                   action="delete"
                                   @delete="deleteUser"
                            >
                            </modal>
                            <v-icon small @click="(props.item.id)">
                                delete
                            </v-icon>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-container></template>

<script>
    import Modal from './../elements/modal';

    export default {
        components: {
            'modal': Modal
        },
        data () {
            return {
                headers: [
                    {
                        text: 'ID',
                        align: 'left',
                        value: 'id'
                    },
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Creation date', value: 'created_at' },
                    { text: 'Actions', value: 'name', sortable: false },
                ],
                users: []
            }
        },
        methods: {
            getUsers() {
                axios.get('api/users').then(res => {
                    this.users = res.data;
                });
            },
            deleteUser(id) {
                axios.delete(`api/users/${id}`).then(() => {
                    this.getUsers();
                });
            }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>