<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from '@vue/reactivity';
import { EMPTY_OBJ } from '@vue/shared';
import { onMounted } from 'vue';

const user = computed(() => usePage().props.auth.user)
var flash = computed(() => usePage().props.flash)
var hidden = ref(false)




</script>


<template>
    <v-layout>

        <v-app-bar :elevation="1" title="Applcation Test">
            <v-btn href="/logout">Logout</v-btn>
        </v-app-bar>

        <v-navigation-drawer :elevation="5">
            <v-list v-if="user.is_admin" density="compact">
                <v-list-item title="Admins" href="/admin/admins"></v-list-item>
                <v-list-item title="Entreprises" href="/admin/companies"></v-list-item>
                <v-list-item title="Employees" href="/admin/employees"></v-list-item>
                <v-list-item title="Invitations" href="/admin/invitations"></v-list-item>
                <v-list-item title="Module Histoire" href="/admin/activty_log"></v-list-item>
            </v-list>
            <v-list v-else density="compact">
                <v-list-item title="Dashboard" href="/dashboard"></v-list-item>
            </v-list>

        </v-navigation-drawer>


        <v-main style="min-height: 100%;margin-top: 100px;display: flex;justify-content: center; ">
            <slot />
        </v-main>
        <div v-if="flash.message" style="position: absolute;right: 10px">
            <v-col sm="12">
                <v-alert style="z-index: 10000;" v-if="flash.status != '201'" color="red lighten-2" dark>
                    {{ flash.message }}
                </v-alert>
                <v-alert style="z-index: 10000;" v-else-if="flash.status == '201'" color="green" dark>
                    {{ flash.message }}
                </v-alert>
            </v-col>
        </div>
    </v-layout>
</template>
