<template>
    <div class="m-5">
        <div class="w-full flex justify-between items-center">
            <p class="px-5">Hello Daniel 👋</p>
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
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[280px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1  "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-md text-gray-400 pb-5">
                            Last Login
                        </span>
                        <span className="text-xl mb-1 flex justify-end">
                            wed 7th 2022</span
                        >
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[280px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1  "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-md text-gray-400 pb-5">
                            Department
                        </span>
                        <span
                            className="text-xl text-gray-700 mb-1 flex justify-end"
                        >
                            Marketing
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-3 shadow-md h-24 w-[280px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1  "
            >
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span -1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-md text-gray-400 pb-5">
                            Credentials
                        </span>
                        <span
                            className="text-xl text-gray-700 mb-1 flex justify-end"
                        >
                            3
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-md p-2 shadow-md bg-white m-2">
            <EasyDataTable :headers="headers" :items="items" border-cell >
            <template #item-operation="item">
                <div class="operation-wrapper">
                    <button
                        class="rounded-sm bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                        @click="deleteItem(item.id)"
                    >
                        Delete
                    </button>
                 </div
            ></template>
            </EasyDataTable>
        </div>
    </div>
</template>

<script>
export default {
    setup() {
        const headers = [];
        const items = [];
        return { headers, items };
    },
};
</script>
