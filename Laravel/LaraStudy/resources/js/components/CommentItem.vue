<template>
    <!-- component -->
    <div x-data="{ open1: false, open2: false }" class="my-5">
        <div class="bg-gray-100 flex justify-center items-center">
            <div
                class="bg-white w-full sm:max-w-7xl md:w-1/3 h-auto shadow px-3 py-2 flex flex-col space-y-2"
            >
                <div class="flex items-center space-x-2">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="block">
                            <div
                                class="flex justify-center items-center space-x-2"
                            >
                                <div
                                    class="bg-gray-100 w-auto rounded-xl px-2 pb-2"
                                >
                                    <div class="font-medium">
                                        <a
                                            href="#"
                                            class="hover:underline text-sm"
                                        >
                                            <small>{{
                                                comment.user.name
                                            }}</small>
                                        </a>
                                    </div>
                                    <input
                                        class="text-xs"
                                        v-model="newComment"
                                        :readonly="!updateClicked"
                                        type="text"
                                        value=""
                                        :id="'comment' + comment.id"
                                    />
                                    <small
                                        v-show="updateClicked"
                                        @click="updateComment"
                                        v-if="comment.user_id == login_user_id"
                                        class="px-2 hover:bg-blue-400"
                                        >Save</small
                                    >
                                </div>
                                <div
                                    class="self-stretch flex justify-center items-center transform transition-opacity duration-200 opacity-0 hover:opacity-100"
                                >
                                    <a href="#" class="">
                                        <div
                                            class="text-xs cursor-pointer flex h-6 w-6 transform transition-colors duration-200 hover:bg-gray-100 rounded-full items-center justify-center"
                                        >
                                            <svg
                                                class="w-4 h-6"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                                ></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="flex justify-start items-center text-xs w-full"
                            >
                                <div
                                    class="font-semibold text-gray-700 px-2 flex items-center justify-center space-x-1"
                                >
                                    <!-- <button class="btn btn-warning">
                                        수정
                                    </button>
                                    <button class="btn btn-danger">
                                        삭제
                                    </button> -->
                                    <small class="self-center">.</small>

                                    <small
                                        @click="enableUpdate"
                                        v-if="comment.user_id == login_user_id"
                                        class="px-2 hover:bg-blue-400"
                                        >Update</small
                                    >
                                    <small class="self-center">.</small>

                                    <small
                                        @click="onClickDelete"
                                        class="px-2 hover:bg-blue-400"
                                        v-if="comment.user_id == login_user_id"
                                        >Delete</small
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Comment Paste Here -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["comment", "login_user_id"],

    data() {
        return {
            newComment: "",
            updateClicked: false
        };
    },
    created() {
        this.newComment = this.comment.comment;
    },
    methods: {
        onClickDelete() {
            if (confirm("Are you sure to delete")) {
                axios
                    .delete("/comments/" + this.comment.id)
                    .then(res => {
                        // console.log(res.data);
                        this.$emit("deleted");
                        // this.$parent.getComment();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        enableUpdate() {
            this.updateClicked = true;
        },
        updateComment() {}
    }
};
</script>
