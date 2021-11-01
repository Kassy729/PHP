<template>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <form @submit.prevent="storeComment">
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
            comment: ""
        };
    },
    props: ["post"],
    methods: {
        storeComment() {
            const form = new FormData();
            form.append("comment", this.comment);
            axios
                .post("/comments/" + this.post.id, form)
                .then(res => {
                    console.log(res);
                    location.reload();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
