<!-- Access if validated -->
<!-- Modify own Informations -->
<template>
    <div style="width: 95%;" class="d-flex justify-center">
        <v-card width="35%" style="margin-right: 20px;">
            <v-card-title primary-title>
                Mes Informations
                <v-card-text>
                    <v-form @submit.prevent="validate()">
                        <v-row>
                            <v-col>
                                <v-text-field label="Email" v-model="form.email" disabled></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field type="text" :disabled="disabled" :error-messages="form.errors.last_name"
                                    v-model="form.last_name" label="Nom">
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field type="text" :disabled="disabled" :error-messages="form.errors.first_name"
                                    v-model="form.first_name" label="Prenom">
                                </v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <v-text-field type="date" :disabled="disabled" :error-messages="form.errors.birth_day"
                                    v-model="form.birth_day" label="Date de naissance">
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field type="text" :disabled="disabled" :error-messages="form.errors.adresse"
                                    v-model="form.adresse" label="Adresse">
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field label="Phone" :disabled="disabled" :error-messages="form.errors.phone"
                                    v-model="form.phone"></v-text-field>
                            </v-col>
                        </v-row>

                        <v-btn @click="enable()" :hidden="!disabled" style="left: 80%;" color="blue">
                            Modifier
                        </v-btn>
                        <v-btn type="submit" :hidden="disabled" style="left: 80%;" color="blue">
                            Valider
                        </v-btn>
                    </v-form>
                </v-card-text>
            </v-card-title>
        </v-card>
        <div style="width:50%;">
            <v-card style="height: fit-content;">
                <v-card-title primary-title>
                    Informations d'emtreprise
                    <v-card-text>
                        <v-card-item>
                            <v-card-title>{{ company.name }}</v-card-title>

                            <v-card-subtitle class="d-flex flex-column">
                                <span class="me-1">Tax ID : {{ company.tax_number }}</span>
                                <span class="me-1">Secteur : {{ company.sector }}</span>

                            </v-card-subtitle>
                        </v-card-item>
                    </v-card-text>
                </v-card-title>
            </v-card>
            <v-card style="margin-top: 10px;min-height: 350px;">
                <v-card-title primary-title>
                    Employees
                    <v-card-text>
                        <v-data-table  items-per-page='10' :headers="headers" :items="employees"
                            item-value="id" class="elevation-1">
                        </v-data-table>
                    </v-card-text>
                </v-card-title>
            </v-card>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { VDataTable } from 'vuetify/labs/VDataTable'
let disabled = ref(true)
function validate() {
    console.log(form.errors)
    // TODO FIX Disbaled
    form.post('/employee/update')
    if (Object.keys(form.errors).length === 0) {
        disabled.value = true
    }
}
function enable() {
    disabled.value = false
}
const props = defineProps({
    company: Object,
    user: Object,
    employees:Array
})
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
        title: 'Adresse', align: 'start', key: 'adresse',
    },
    {
        title: 'Date de naissance', align: 'start', key: 'birth_day',
    },
    {
        title: 'Tel', align: 'start', key: 'phone',
    },
]
const form = useForm({
    id: props.user.id,
    last_name: props.user.last_name,
    first_name: props.user.first_name,
    email: props.user.email,
    phone: props.user.phone,
    birth_day: props.user.birth_day,
    adresse: props.user.adresse,
})

</script>

<script>
import Layout from '../Layout.vue';
import { ref } from 'vue';

export default {
    layout: Layout
}
</script>
