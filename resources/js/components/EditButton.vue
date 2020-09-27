<template>

    <a type="button" class="btn btn-primary" role="button" :href="link">
        <span>Edit</span>
    </a>

</template>

<script>

export default {

    props: ['uri'],

    data: function () {
        return {
            link: `${window.location.origin}/coding-test/${this.uri}`
        }
    }
}
</script>
