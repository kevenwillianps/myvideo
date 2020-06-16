<template>

    <div v-bind:class="'alert alert-' + class_name + ' shadow-sm'" role="alert">

        <h4 class="alert-heading">

            <strong>Anteção!</strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </h4>

        <p>

            {{ message }}

        </p>

    </div>

</template>

<script type="text/ecmascript-6">

    export default {

        name: "QueryAlert",

        props : {

            class_name : null,
            message    : [],

        }

    }

</script>