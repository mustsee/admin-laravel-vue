<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-dialog
            v-model="dialog"
            width="500"
    >
        <template v-slot:activator="{ on }">
            <v-icon small v-on="on">
                {{ action }}
            </v-icon>
        </template>
        <v-card>
            <v-card-title
                    class="headline lighten-2"
                    primary-title
            >
                {{ actionCapitalLetter }} {{ itemName }} {{ itemValue }} ?
            </v-card-title>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                        color="red"
                        flat
                        @click="dialog = false"
                >
                    Cancel
                </v-btn>
                <v-btn
                        color="primary"
                        flat
                        @click="handleDelete"
                >
                    {{ action }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
    export default {
        props: ['action', 'id', 'itemName', 'itemValue'],
        data () {
            return {
                dialog: false
            }
        },
        computed: {
            actionCapitalLetter() {
                return this.action.slice(0,1).toUpperCase() + this.action.slice(1);
            }
        },
        methods: {
            handleDelete() {
                this.dialog = false;
                this.$emit('delete', this.id);
            }
        }
    }
</script>