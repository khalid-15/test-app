<!-- List Companies / Search / Sort by name -->
<!-- Edit Companies -->
<!-- create Companies -->
<!-- Can Delete Companies with no employee -->
<!-- Invite New Employees to Company Modal-->
<!--  List admins -->
<!--  Create Admins -->
<template>
    <v-container width="75%" style="display:flex; flex-direction: column;">
        <v-btn color="success" style="margin-bottom: 10px;" href="/admin/companies/create">Creer</v-btn>
        <v-text-field v-model="search" style="margin-bottom: 10px"  label="Search" single-line hide-details></v-text-field>
        <!-- Add delete Button -->
        <v-data-table items-per-page='10'  :search="search" :headers="headers" :items="companies" item-value="id" class="elevation-1">
            <template v-slot:item.action="{ item }">
                <v-btn density="compact" :href="'/admin/companies/edit/' + item.raw.id" color="blue"
                    style="margin-right: 4px;">Edit</v-btn>
                <v-btn density="compact" :href="'/admin/companies/delete/' + item.raw.id" color="red"
                    style="margin-right: 4px;">Delete</v-btn>
                <v-btn density="compact" @click="openDialog(item.raw.id)" color="primary">Invite</v-btn>
            </template>
        </v-data-table>

        <v-row justify="center">
            <v-dialog v-model="dialog" persistent width="550">
                <v-card>
                    <v-card-title>
                        <span class="text-h7 align-center">Invitation</span>
                    </v-card-title>
                    <v-form @submit.prevent="form.post('/admin/invitations')">
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field label="Prenom" :error-messages="form.errors.first_name"
                                            v-model="form.first_name" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field label="Nom" :error-messages="form.errors.last_name"
                                            v-model="form.last_name"></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="Email" :error-messages="form.errors.email" v-model="form.email"
                                            required></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                                Fermer
                            </v-btn>
                            <v-btn color="blue-darken-1" variant="text" type="submit" @click="dialog = false">
                                Inviter
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>
        </v-row>
    </v-container>
</template>

<script setup>
import { usePage, useForm } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
defineProps({
    companies: Array,
})


var dialog = ref(false)
var search = ref('')
function openDialog(id) {
    dialog.value = true
    form.company_id = id
}
const form = useForm({
    company_id: '',
    first_name: '',
    last_name: '',
    email: '',
})

var headers = [
    {
        title: 'Denomination', align: 'start', key: 'name',
    },
    {
        title: 'Tax ID', align: 'start', sortable: false, key: 'tax_number',
    },
    {
        title: 'Secteur', align: 'start', sortable: false, key: 'sector',
    },
    {
        title: 'Actions', sortable: false, key: "action"
    }
]

</script>

<script>
import Layout from '../../Layout.vue';

export default {
    layout: Layout
}
</script>
