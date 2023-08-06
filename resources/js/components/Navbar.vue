<template>
    <nav class="flex justify-between items-center">
        <div>Dashboard</div>
        <div class="flex gap-x-8">
            <v-text-field
                density="compact"
                variant="solo"
                label="Search "
                append-inner-icon="mdi-magnify"
                single-line
                hide-details
                class="w-56"
            ></v-text-field>

            <v-avatar>
                <v-img
                    src="https://cdn.vuetifyjs.com/images/john.jpg"
                    alt="John"
                ></v-img>
            </v-avatar>
        </div>
    </nav>
</template>
