<template>
    <v-card>
        <v-card-title primary-title>
            Historique des actions
        </v-card-title>
        <v-card-text>
            <v-timeline side="end" align="start">
                <v-timeline-item v-for="a in activities" dot-color="pink" size="small">
                    <div class="d-flex">
                        <strong class="me-4">{{ moment(a.created_at).format("DD-MM-YYYY h:mm") }}</strong>
                        <div>
                            <div class="" style="font-size: large;">
                                {{a.description}}
                            </div>
                        </div>
                    </div>
                </v-timeline-item>
            </v-timeline>
        </v-card-text>
    </v-card>
</template>
<script setup>
import moment from "moment";
defineProps({
    activities : Array
})
</script>
<script>
import Layout from '../Layout.vue';

export default {
    layout: Layout
}
</script>

