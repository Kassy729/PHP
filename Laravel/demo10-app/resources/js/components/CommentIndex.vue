<template>
    <div>
        <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">내용</th>
                    <th scope="col">작성자</th>
                    <th scope="col">수정</th>
                    <th scope="col">삭제</th>
                </tr>
            </thead>
            <tbody v-for="comment in comments" :key="comment.id">
                <tr>
                    <td>{{ comment.comment }}</td>
                    <td>{{ comment.user.name }}</td>
                    <td>
                        <button class="btn btn-warning" @click="onClickEdit">
                            수정
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger" @click="onClickDelete">
                            삭제
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
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
    props: ["post", "loginuser"],
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
        onClickEdit() {},
        onClickDelete() {
            axios
                .delete("/comment/" + this.comment.id)
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
