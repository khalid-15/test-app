<!-- List Invitations -->
<!-- Cancel Invitation -->
<template>
    <v-card width="75%">
        <!-- Add Cancel Button -->
        <v-data-table items-per-page='10' :headers="headers" :items="invitations" item-value="id" class="elevation-1">
            <template v-slot:item.action="{ item }">
                <v-btn density="compact" :disabled="item.raw.status == 'validated' || item.raw.status == 'canceled'"
                    :href="'/admin/invitations/cancel/' + item.raw.id" color="warning"
                    style="margin-right: 4px;">Annuler l'invitation</v-btn>
            </template>
            <template v-slot:item.status="{ item }">
                <v-chip v-if="item.raw.status == 'validated'" variant="elevated" color="blue">
                    Valider
                </v-chip>
                <v-chip v-else-if="item.raw.status == 'sent'" variant="elevated" color="green">
                    Envoyer
                </v-chip>
                <v-chip v-else variant="elevated" color="red">
                    Annuler
                </v-chip>
            </template>
        </v-data-table>
    </v-card>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
defineProps({
    invitations: Array,
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
        title: 'Status', align: 'start', key: 'status',
    },
    {
        title: 'Actions', align: 'start', key: 'action',
    }
]

</script>

<script>
import Layout from '../Layout.vue';

export default {
    layout: Layout
}
</script>

