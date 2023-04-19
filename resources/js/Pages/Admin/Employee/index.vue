<!-- List Employees / sort / search -->
<!-- List Invitations -->
<!-- Cancel Invitation -->
<template>
    <v-card width="75%">
        <!-- Add Cancel Button -->
        <v-text-field v-model="search" style="margin-bottom: 15px"  label="Search" single-line hide-details></v-text-field>
        <v-data-table items-per-page='10' :headers="headers" :items="employees" :search="search" item-value="id" class="elevation-1">
        </v-data-table>
    </v-card>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
defineProps({
    employees: Array,
})
var search = ref('')
var headers = [
    {
        title: 'Nom', align: 'start', key: 'first_name',
    },
    {
        title: 'Prenom', align: 'start', key: 'last_name',
    },
    {
        title: 'Email', align: 'start', key: 'email',
    },
    {
        title: 'Company', align: 'start', key: 'company.name',
    },
    {
        title: 'Adresse', align: 'start', key: 'adresse',
    },
    {
        title: 'Date de naissance', align: 'start', key: 'birth_day',
    },
    {
        title: 'Tel', align: 'start', key: 'phone',
    },
]

</script>

<script>
import Layout from '../../Layout.vue';

export default {
    layout: Layout
}
</script>

