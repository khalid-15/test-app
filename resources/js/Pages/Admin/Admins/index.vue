<!--  List admins -->
<!--  Create Admins -->
<template>
    <v-container width="75%" style="display:flex; flex-direction: column;">
        <v-btn color="success" style="margin-bottom: 10px;" href="/admin/admins/create">Creer</v-btn>
        <!-- Add delete Button -->

        <v-data-table items-per-page='10' :headers="headers" :items="admins" item-value="id" class="elevation-1">
        </v-data-table>
    </v-container>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
defineProps({
    admins: Object,
})
var headers = [
    {
        title: 'Nom', align: 'start', sortable: true, key: 'first_name',
    },
    {
        title: 'Prenom', align: 'start', sortable: false, key: 'last_name',
    },
    {
        title: 'Email', align: 'start', sortable: false, key: 'email',
    },
    {
        title: '', value: "controls", sortable: false,
    }
]

</script>

<script>
import Layout from '../../Layout.vue';

export default {
    layout: Layout
}
</script>
