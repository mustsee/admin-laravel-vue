<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid fill-height>
        <v-layout justify-center>
            <v-flex>
                <v-tabs
                        v-model="active"
                        color="cyan"
                        dark
                        slider-color="yellow"
                >
                    <v-tab
                            v-for="(tab, i) in tabs"
                            :key="tab"
                            ripple
                    >
                        {{ tabName(i) }}

                    </v-tab>
                    <v-tab-item
                            v-for="tab in tabs"
                            :key="tab"
                    >
                        <component :is="tab"/>
                    </v-tab-item>
                </v-tabs>
            </v-flex>
        </v-layout>
    </v-container></template>

<script>
    import MonumentTable from './tables/MonumentTable';
    import MonumentTranslationsTable from './tables/MonumentTranslationsTable';

    export default {
        components: {
            'monument-table': MonumentTable,
            'monument-translations-table': MonumentTranslationsTable,
        },
        data () {
            return {
                active: null,
                tabs: ['monument-table', 'monument-translations-table']
            }
        },
        methods: {
            tabName(i) {
                if (i === 0) return 'Monuments';
                return 'Monument translations'
            }
        }
    }
</script>