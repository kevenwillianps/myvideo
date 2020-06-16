<template>

    <div class="alert alert-warning shadow-sm animated animatedFadeInUp fadeInUp" role="alert">

        <h4 class="alert-heading">

            <strong>Atenção!</strong> {{ title }}

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

        name: "AlertOrientation",

        props : {

            title   : null,
            message : null,

        }

    }

</script>