<template>
    <div class="m-5">
        <div class="w-full flex justify-between items-center">
            <p class="px-5">Hello  {{ users.current_user.name }}  👋</p>
            <button
                className="flex px-2 mx-5 py-2  items-center rounded-md text-white text-sm bg-yellow-400 shadow-lg"
            >
                <p className="text-md">
                    <v-icon icon="mdi-sync" />
                </p>
                <p className="pl-1 pr-2">Refresh</p>
            </button>
        </div>

        <div class="flex justify-around">
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[210px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1"> 6 </span>
                        <span className="text-md text-gray-400">
                            Total visits today
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[210px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">
                            {{ users.userCount }}
                        </span>
                        <span className="text-md text-gray-400">
                            Total users
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[210px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span -1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">
                            {{ credentials.credentialCount }}
                        </span>
                        <span className="text-md text-gray-400">
                            Saved Credentials
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[210px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">
                            {{ roles.roleCount }}
                        </span>
                        <span className="text-md text-gray-400">
                            Departments
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-gray-600 text-lg m-3">Logs</p>
        <div class="rounded-md p-2 shadow-md bg-white m-2">
            <EasyDataTable :headers="headers" :items="items" border-cell>
                <template #item-date-operation="item">
                    <div class="operation-wrapper">
                        {{
                            item.logs
                                ? new Date(item.logs.last_login)
                                      .toString()
                                      .slice(0, 24)
                                : " no logs"
                        }}
                    </div></template
                >

                <template #item-operation="item">
                    <div class="operation-wrapper">
                        <button
                            class="rounded-sm bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                            @click="deleteItem(item.id)"
                        >
                            Delete
                        </button>
                    </div></template
                >
            </EasyDataTable>
        </div>
    </div>
</template>
<script>
import { onMounted, ref } from "vue";
import {
    getUsers,
    getCredentials,
    getRoles,
    getLogs,
} from "../api/services.js";
export default {
    setup() {
        const users = ref([]);
        const credentials = ref([]);
        const roles = ref([]);
        const items = ref([]);
        const logs = ref([]);

        onMounted(async () => {
            users.value = await getUsers();
            credentials.value = await getCredentials();
            roles.value = await getRoles();
            items.value = await getLogs();
            items.value.map((item) => {
                if (item.logs) {
                    console.log(item);
                    console.log(
                        new Date(item.logs.last_login).toString().slice(0, 24)
                    );
                }
            });
        });
        const headers = [
            { text: "Name ", value: "name" },
            { text: "Department ", value: "department" },
            { text: "Email ", value: "email" },
            { text: "Last logged in", value: "date-operation" },
        ];
        function deleteItem(id) {
            axios;
        }

        return {
            headers,
            items,
            users,
            credentials,
            roles,
            items,
            deleteItem,
            logs,
        };
    },
};
</script>
