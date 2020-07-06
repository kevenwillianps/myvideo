<template>

    <div>

        <div class="row">

            <div class="col-md-12">

                <h4>

                    <i class="far fa-folder-open mr-1"></i>Usuários

                </h4>

            </div>

            <div class="col-md-12 mb-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-2" v-for="(result, index) in query.result.user" v-bind:key="index" v-else>

                <div class="card shadow-sm animate animate__fadeIn">

                    <div class="card-body">

                        <img v-bind:src="result.file_path + '/' + result.file_name" v-bind:alt="result.file_name" class="mr-3 rounded img-fluid shadow-sm">

                        <h4 class="card-title mb-2">

                            {{ result.user_name }}

                        </h4>

                        <h6 class="card-subtitle text-muted">

                            {{ result.user_function }}

                        </h6>

                        <p class="card-text">

                             <span class="text-muted">

                                <i class="fas fa-hashtag mr-1"></i>{{ result.user_id }}

                            </span>

                            -

                            <span class="text-muted">

                                <i class="fas fa-birthday-cake mr-1"></i>{{ result.date_birth }}

                            </span>

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <h4>

                    <i class="far fa-folder-open mr-1"></i>Palylist

                </h4>

            </div>

            <div class="col-md-12 mb-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4" v-for="(result, index) in query.result.content" v-bind:key="index" v-else>

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="d-flex" v-if="result.file_name && result.file_type === 'video/mp4'">

                            <video width="100%" controls class="mx-auto my-auto rounded border-dashed">

                                <source v-bind:src="result.file_path + '/' + result.file_name" type="video/mp4">

                            </video>

                        </div>

                        <div class="d-flex" v-else-if="result.file_name">

                            <img v-bind:src="result.file_path + '/' + result.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="result.file_name">

                        </div>

                        <h4 class="mb-0 card-title">

                            <strong>

                                {{ result.title }}

                            </strong>

                        </h4>

                        <div class="mt-1">

                            <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ result.date_register }}</span> - <span class="text-muted">{{ result.user_name }}</span> - <span class="text-muted">{{ result.user_function }}</span>

                        </div>

                    </div>

                    <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">

                                    <a class="nav-link" type="button" v-on:click="EditForm(result.content_id, result.title, result.content_complete)" v-if="session.user_id == result.user_id">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_id = result.content_id" v-if="session.user_id == result.user_id">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id}}" class="nav-link">

                                        <i class="far fa-eye mr-1"></i>Ver

                                    </router-link>

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <h4>

                    <i class="far fa-folder-open mr-1"></i>Conteúdo

                </h4>

            </div>

            <div class="col-md-12 mb-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4" v-for="(result, index) in query.result.content_sub" v-bind:key="index" v-else>

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="d-flex" v-if="result.file_name && result.file_type === 'video/mp4'">

                            <img v-bind:src="query.result_content.file_path + '/' + query.result_content.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="query.result_content.file_name">

                        </div>

                        <div class="d-flex" v-else-if="result.file_name">

                            <img v-bind:src="result.file_path + '/' + result.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="result.file_name">

                        </div>

                        <h4 class="card-title">

                            <strong>

                                {{ result.title }}

                            </strong>

                        </h4>

                        <div class="mt-1">

                            <span class="text-muted">

                                <i class="fas fa-hashtag mr-1"></i>{{result.content_sub_id}}

                            </span> -

                            <span class="text-muted">

                                <i class="far fa-clock mr-1"></i>{{result.date_register}}

                            </span> -

                            <span class="text-muted">

                                {{result.user_name}}

                            </span> -

                            <span class="text-muted">

                                {{result.user_function}}

                            </span>

                        </div>

                    </div>

                    <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#MenuContentSubDatagrid_' + result.content_sub_id" v-bind:aria-controls="'#MenuContentSubDatagrid_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" v-bind:id="'MenuContentSubDatagrid_' + result.content_sub_id">

                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">

                                    <a class="nav-link" type="button" v-on:click="EditForm(result.content_sub_id, result.content_id, result.title, result.content_complete)" v-if="session.user_id == result.user_id">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_sub_id = result.content_sub_id" v-if="session.user_id == result.user_id">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <router-link v-bind:to="{name : 'content-sub-details', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id, content_sub_id : result.content_sub_id}}" class="nav-link">

                                        <i class="far fa-eye mr-1"></i>Ver

                                    </router-link>

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios'
    import Progress from '../../components/Geral/Progress';

    export default {

        name: "SearchDatagridAuxiliary",

        components : {

            Progress,

        },

        data (){

            return {

                form : {

                    progress_bar : false,
                    show_form    : false,

                },
                inputs : {

                    search : this.$route.params.search,

                },
                query : {

                    result : {

                        user : [],
                        content : [],
                        content_sub : [],

                    }

                },
                /** Dados da Seção **/
                session : {

                    user_id          : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        methods : {

            /** Realizo a busca de conteúdo **/
            Search(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=SEARCH&ACTION=SEARCH_DATAGRID', {inputs : this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Desabilito minha barra de progresso **/
                        this.query.result.user = response.data.result_user;
                        this.query.result.content = response.data.result_content;
                        this.query.result.content_sub = response.data.result_content_sub;

                        window.setTimeout(() => {

                            /** Habilito minha barra de progresso **/
                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log(response.data)

                    });

            },

        },

        mounted(){

            this.Search();

        }

    }

</script>