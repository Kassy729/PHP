<template>
    <div>
        <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <p
            v-for="comment in comments"
            :key="comment.id"
            class="form-control"
            type="text"
            aria-label="readonly input example"
            readonly
        >
            {{ comment.comment }}
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comments: [],
        };
    },
    created() {
        this.getComment();
    },
    props: ["post"],
    methods: {
        getComment() {
            axios
                .get("/comment/" + this.post.id)
                .then((res) => {
                    console.log(res.data);
                    this.comments = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
