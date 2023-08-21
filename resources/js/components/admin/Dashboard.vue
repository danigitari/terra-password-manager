<template>
    <div class="m-5">
        <div class="w-full flex justify-between items-center ">
            <p class="px-5">Hello Daniel 👋</p>
            <button
                className="flex px-2 mx-5 py-2  items-center rounded-md text-white text-sm bg-yellow-400 shadow-lg"
            >
                <p className="text-md">
                    <v-icon icon="mdi-sync"  />
                </p>
                <p className="pl-1 pr-2">Refresh</p>
            </button>
        </div>

        <div class="flex justify-around">
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-4 shadow-md h-32 w-[200px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1">
                    <div
                        className="flex justify-end p-2 text-green-500 text-xl "
                    >
                        <v-icon icon="fas fa arrow-up" />
                        <p className="px-2 text-sm">+ 2 %</p>
                    </div>
                </div>
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">7 </span>
                        <span className="text-md text-gray-400">
                            Total visits today 
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-4 shadow-md h-32 w-[200px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1">
                    <div
                        className="flex justify-end p-2 text-green-500 text-xl "
                    >
                        <v-icon icon="fas fa arrow-up" />
                        <p className="px-2 text-sm">+ 2 %</p>
                    </div>
                </div>
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">7 </span>
                        <span className="text-md text-gray-400">
                            Total users
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-4 shadow-md h-32 w-[200px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1">
                    <div
                        className="flex justify-end p-2 text-green-500 text-xl"
                    >
                        <v-icon icon="fas fa arrow-up" />
                        <p className="px-2 text-sm">+ 2 %</p>
                    </div>
                </div>
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span -1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">17 </span>
                        <span className="text-md text-gray-400">
                            Saved Credentials
                        </span>
                    </div>
                </div>
            </div>
            <div
                className="row-span-1 lg:row-span-2  grid grid-row-4 shadow-md h-32 w-[200px] my-5 rounded-lg bg-white sm:m-3 lg:m-0 lg:my-1 "
            >
                <div className="row-span-1">
                    <div
                        className="flex justify-end p-2 text-green-500 text-xl "
                    >
                        <v-icon icon="fas fa arrow-up" />
                        <p className="px-2 text-sm">+ 2 %</p>
                    </div>
                </div>
                <div className="row-span-1"></div>
                <div className="row-span-1"></div>
                <div className="row-span-1">
                    <div className="flex flex-col justify-start p-2 ">
                        <span className="text-3xl mb-1">7 </span>
                        <span className="text-md text-gray-400">
                            Departments
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
