<template>
    <div class="mb-3">
        <form @submit.prevent="onClickSubmit">
            <input
                type="text"
                class="form-control"
                v-model="comment"
                id="exampleFormControlInput1"
                placeholder="댓글"
            />
            <button class="btn btn-primary">작성</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            comment: "",
        };
    },
    props: ["post"],
    methods: {
        onClickSubmit() {
            const form = new FormData();
            form.append("comment", this.comment);
            axios
                .post("/comment/" + this.post.id, form)
                .then((res) => {
                    console.log(res.data);
                    location.reload();
                    //페이지 새로고침
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
