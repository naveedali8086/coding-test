<template>

    <div class="form-group">

        <label v-bind:for="id">{{ label }}</label>

        <input type="text" v-bind:class="['form-control', error?'is-invalid':'']" v-bind:id="id"
               v-bind:value="value" v-on:input="$emit('input', $event.target.value)">


        <div class="invalid-feedback" v-if="error">
            {{ error }}
        </div>

    </div>

</template>

<script>
export default {
    props: [
        'id',
        'label',
        'error',
        'value'
    ]
}
</script>
