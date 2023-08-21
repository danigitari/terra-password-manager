<template>
    <div class="mt-5">
        <v-row class="flex justify-end p-5 mx-1 ">
            <v-dialog v-model="dialog" persistent width="720">
                <template v-slot:activator="{ props }">
                    <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                        v-bind="props"
                    >
                        <v-icon icon="mdi-plus"></v-icon> Add New Credential
                    </button>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h6">Add New Credential</span>
                    </v-card-title>
                    <hr />
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Full Name"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-select
                                        :items="[
                                            'Development',
                                            'Sales',
                                            'Finance',
                                            
                                        ]"
                                        label="Department"
                                        required
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Phone Number*"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Email*"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions class="m-5 ">
                        <v-spacer></v-spacer>
                  <button
                        class="rounded-sm bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                            @click="dialog = false"
                        >
                            Close
                        </button>
                        <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                            @click="dialog = false"
                        >
                         Save
                        </button>
      
    
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
    <div class="m-5 bg-white shadow-lg rounded-md p-2 ">
        <EasyDataTable :headers="headers" :items="items" border-cell />
    </div>

</template>


// import  { Header, Item } from "vue3-easy-data-table";
<script>
import { ref } from "vue";
export default {
    setup() {
        const headers = [
            { text: "Name ", value: "name" },
            { text: "Department ", value: "department" },
            { text: "Email ", value: "email" },
            { text: "Phone Number ", value: "number" },
        ];

        const items = [
            {
                player: "D",
                team: "GSW",
                number: 30,
                position: "G",
                indicator: { height: "6-2", weight: 185 },
                lastAttended: "Davidson",
                country: "USA",
            },
            {
                player: "Lebron James",
                team: "LAL",
                number: 6,
                position: "F",
                indicator: { height: "6-9", weight: 250 },
                lastAttended: "St. Vincent-St. Mary HS (OH)",
                country: "USA",
            },
            {
                player: "Kevin Durant",
                team: "BKN",
                number: 7,
                position: "F",
                indicator: { height: "6-10", weight: 240 },
                lastAttended: "Texas-Austin",
                country: "USA",
            },
            {
                player: "Giannis Antetokounmpo",
                team: "MIL",
                number: 34,
                position: "F",
                indicator: { height: "6-11", weight: 242 },
                lastAttended: "Filathlitikos",
                country: "Greece",
            },
        ];
        const dialog = ref(false);
        return {
            headers,
            items,
            dialog,
        };
    },
};
</script>

