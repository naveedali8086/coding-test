<template>

    <button type="submit" class="btn btn-primary">
        <span v-if="!is_submitting">Save</span>
        <span v-if="is_submitting" class="spinner-border spinner-border-sm"></span>
        <span v-if="is_submitting">Saving</span>
    </button>

</template>

<script>
export default {
    props: ['is_submitting']
}
</script>
