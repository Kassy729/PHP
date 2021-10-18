<template>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <form @submit.prevent="commentStore">
            <input
                type="text"
                class="form-control"
                v-model="comment"
                id="exampleFormControlInput1"
                placeholder="댓글"
            />
            <button type="submit" class="btn btn-primary">작성</button>
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
        commentStore() {
            const form = new FormData();
            form.append("comment", this.comment);
            axios
                .post("/commentStore/" + this.post.id, form)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
