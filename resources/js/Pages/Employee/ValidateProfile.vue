<!-- Token Based Link -->
<!-- Validate Employee information -->
<template>
    <v-card class="w-50 mx-auto mt-16 ">
        <v-container>
            <v-form @submit.prevent="form.post('/employee/validate')">
                <v-row>
                    <v-col>
                        <v-text-field label="Email" v-model="form.email" disabled></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.last_name" v-model="form.last_name"
                            label="Nom">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.first_name" v-model="form.first_name"
                            label="Prenom">
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <v-text-field type="date" :error-messages="form.errors.birth_day" v-model="form.birth_day"
                            label="Date de naissance">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field type="text" :error-messages="form.errors.adresse" v-model="form.adresse"
                            label="Adresse">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field label="Phone" :error-messages="form.errors.phone" v-model="form.phone"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-text-field label="Password" :error-messages="form.errors.password" v-model="form.password"  type="password"></v-text-field>
                    </v-col>
                </v-row>

                <v-btn type="submit" color="blue">
                    Confirmer Profile
                </v-btn>
            </v-form>
        </v-container>
        {{ user }}
    </v-card>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
var props = defineProps({
    invitation: Object
})

const form = useForm({
    id : props.invitation.id,
    last_name: props.invitation.last_name,
    first_name: props.invitation.first_name,
    email: props.invitation.email,
    phone: '',
    birth_day: '',
    adresse: '',
    password : ''
})
</script>
