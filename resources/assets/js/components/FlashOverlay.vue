<template>
<v-dialog v-model="show" persistent width="600">
    <v-card>
        <v-card-row>
            <v-card-title>{{ title }}</v-card-title>
        </v-card-row>
        <v-card-row>
            <v-card-text>{{ body }}</v-card-text>
        </v-card-row>
        <v-card-row actions>
            <v-btn class="green--text darken-1" flat="flat" @click.native="show = false">Close</v-btn>
        </v-card-row>
    </v-card>
</v-dialog>
</template>

<script>
    export default {
        props: ['title', 'body'],

        data() {
            return {
                show: true
            }
        }
    }
</script>
