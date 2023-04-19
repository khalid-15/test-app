<template>
    <v-card class="w-50 mx-auto mt-16 ">
        <v-card-title>
            Login
        </v-card-title>
        <v-container>
            <v-form @submit.prevent="form.post('/login')">
                <v-row>
                    <v-col>
                        <v-text-field label="Email"  :error-messages="form.errors.email" v-model="form.email"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="password"  :error-messages="form.errors.password" v-model="form.password" label="Password">
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
    email : 'admin@admin.com',
    password: 'demo',
})




</script>
