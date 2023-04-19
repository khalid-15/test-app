<template>
    <v-card class="w-50 mx-auto mt-16 ">
        <v-container>
            <v-form @submit.prevent="form.post('/admin/companies/store')">
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.name" v-model="form.name"
                            label="Prenom">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.sector" v-model="form.sector"
                            label="Prenom">
                        </v-text-field>
                    </v-col>
                </v-row> <v-row>
                    <v-col>
                        <v-text-field label="Email" :error-messages="form.errors.tax_number" v-model="form.tax_number"></v-text-field>
                    </v-col>
                </v-row>
                <v-btn type="submit">
                    Valider
                </v-btn>
            </v-form>
        </v-container>
    </v-card>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue';

const form = useForm({
    name: 'Company X',
    sector: 'Info',
    tax_number: '100101010',
})


</script>
<script>
import Layout from '../../Layout.vue';

export default {
    layout: Layout
}
</script>
