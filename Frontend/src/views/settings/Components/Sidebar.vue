<template>
    <!-- BEGIN: Inbox Menu -->
    <div class="intro-y box bg-theme-1 p-5 mt-6">
        <button
            type="button"
            class="btn text-gray-700 dark:text-gray-300 w-full bg-white dark:bg-theme-1 mt-1"
        >
            <Edit3Icon class="w-4 h-4 mr-2" /> Compose
        </button>
        <div
            class="border-t border-theme-3 dark:border-dark-5 mt-6 pt-6 text-white"
        >
            <a
                href=""
                class="flex items-center px-3 py-2 rounded-md bg-theme-20 dark:bg-dark-1 font-medium"
            >
                <MailIcon class="w-4 h-4 mr-2" /> Inbox
            </a>
            <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                <StarIcon class="w-4 h-4 mr-2" /> Marked
            </a>
            <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                <InboxIcon class="w-4 h-4 mr-2" /> Draft
            </a>
            <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                <SendIcon class="w-4 h-4 mr-2" /> Sent
            </a>
            <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                <TrashIcon class="w-4 h-4 mr-2" /> Trash
            </a>
        </div>
        <div
            class="border-t border-theme-3 dark:border-dark-5 mt-4 pt-4 text-white"
        >
            <a href="" class="flex items-center px-3 py-2 truncate">
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                Custom Work
            </a>
            <a
                href=""
                class="flex items-center px-3 py-2 mt-2 rounded-md truncate"
            >
                <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                Important Meetings
            </a>
            <a
                href=""
                class="flex items-center px-3 py-2 mt-2 rounded-md truncate"
            >
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                Work
            </a>
            <a
                href=""
                class="flex items-center px-3 py-2 mt-2 rounded-md truncate"
            >
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                Design
            </a>
            <a
                href=""
                class="flex items-center px-3 py-2 mt-2 rounded-md truncate"
            >
                <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                Next Week
            </a>
            <a
                href=""
                class="flex items-center px-3 py-2 mt-2 rounded-md truncate"
            >
                <PlusIcon class="w-4 h-4 mr-2" /> Add New Label
            </a>
        </div>
    </div>
    <!-- END: Inbox Menu -->
</template>