<template>
    <div class="flex justify-end m-5">
        <button
            class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
        >
            <v-icon icon="mdi-plus"></v-icon> Add New User
        </button>
    </div>
    <div class="m-5 bg-white shadow-lg rounded-md p-2">
        <EasyDataTable :headers="headers" :items="items" border-cell />
        
    </div>
</template>

<script>
// import  { Header, Item } from "vue3-easy-data-table";
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
        return {
            headers,
            items,
        };
    },
};
</script>
