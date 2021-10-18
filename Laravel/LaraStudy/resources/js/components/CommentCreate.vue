<template>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="댓글"
        />
        <button class="btn btn-primary">작성</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comment: ""
        };
    }
};
</script>
