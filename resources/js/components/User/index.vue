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
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-container></template>

<script>
    import Modal from './../elements/modal';
    import { cacheName, defaultOptions, usersAPI } from './../../helpers';

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
            CheckUsersCache() {
                caches.open(cacheName).then(cache => {
                    cache.match(usersAPI).then(item => {
                        if (!item) {
                            this.getUsers();
                        } else {
                            item.json().then(body => { this.users = body })
                        }
                    });
                });
            },
            getUsers() {
                fetch(usersAPI, defaultOptions).then(res => {
                    let resClone = res.clone();
                    if (res.status === 200) {
                        caches.open(cacheName).then(cache => {
                            cache.put(usersAPI, res);
                        });
                        resClone.json().then(body => {
                            this.users = body;
                        });
                    } else {
                        console.log('error while fetching api/users');
                    }
                });

            },
            deleteUser(id) {
                axios.delete(`${usersAPI}/${id}`).then(() => {
                    caches.open(cacheName).then(cache => cache.delete(usersAPI));
                    this.getUsers();
                });
            }
        },
        mounted() {
            this.CheckUsersCache();
        }
    }
</script>