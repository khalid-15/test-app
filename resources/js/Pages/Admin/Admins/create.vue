<template>
    <v-card class="w-50 mx-auto mt-16 ">
        <v-container>
            <v-form @submit.prevent="form.post('/admin/admins/store')">
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.first_name" v-model="form.first_name"
                            label="Prenom">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.last_name" v-model="form.last_name"
                            label="Prenom">
                        </v-text-field>
                    </v-col>
                </v-row> <v-row>
                    <v-col>
                        <v-text-field label="Email" :error-messages="form.errors.email" v-model="form.email"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="password" :error-messages="form.errors.password" v-model="form.password"
                            label="Password">
                        </v-text-field>
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
    first_name: 'test',
    last_name: 'test',
    email: 'demo@demo.com',
    password: 'demo',
})


</script>
<script>
import Layout from '../../Layout.vue';

export default {
    layout: Layout
}
</script>
