<template>

    <div>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <h4>

            <i class="fas fa-users mr-1"></i>Usuários com maiores contribuições

        </h4>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div v-else>

            <div class="row">

                <div class="col-md-3 mb-2" v-for="(result, index) in query.result_top_profiles" v-bind:key="index">

                    <div class="card shadow-sm">

                        <img v-bind:src="result.file_path + '/' + result.file_name" v-bind:alt="result.file_name" class="card-img-top">

                        <div class="card-body">

                            <h4 class="card-title mb-0">

                                {{ result.user_name }}

                            </h4>

                            <p class="card-text text-muted">

                                {{ result.user_function }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <hr>

        <h4>

            <i class="fas fa-th-list mr-1"></i>Playlists

        </h4>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div v-else>

            <div class="row">

                <div class="col-md-4 mb-2" v-for="(result, index) in query.result_contents" v-bind:key="index">

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

                            <div class="media mt-2">

                                <div class="media-body">

                                    <h4 class="mb-0">

                                        <strong>

                                            {{ result.title }}

                                        </strong>

                                    </h4>

                                    <div class="mt-1">

                                        <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ result.date_register }}</span> - <span class="text-muted">{{ result.user_name }}</span> - <span class="text-muted">{{ result.user_function }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <nav class="navbar navbar-expand-lg navbar-light bg-light card-footer card-footer-transparent">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <ul class="navbar-nav mr-auto">

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

        </div>

        <hr>

        <h4>

            <i class="far fa-folder-open mr-1"></i>Conteúdos

        </h4>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div v-else>

            <div class="row">

                <div class="col-md-3 mb-4" v-for="(result, index) in query.result_content_subs" v-bind:key="index">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <div class="media">

                                <div class="media-body">

                                    <h4 class="my-3">

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

                            </div>

                        </div>

                        <nav class="navbar navbar-expand-lg navbar-light bg-light card-footer card-footer-transparent">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#MenuContentSubDatagrid_' + result.content_sub_id" v-bind:aria-controls="'#MenuContentSubDatagrid_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'MenuContentSubDatagrid_' + result.content_sub_id">

                                <ul class="navbar-nav mr-auto">

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

    </div>

</template>

<script type="text/ecmascript-6">

    import axios        from 'axios';
    import Progress     from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "AdventureDatagrid",

        components : {

            Progress,
            ModalConfirm,

        },

        data(){

            return{

                /** Controle do HTML **/
                form : {

                    progress_bar : false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result_top_profiles : [],
                    result_contents     : [],
                    result_content_subs : [],

                },
                /** Dados da Seção **/
                session : {

                    user_id          : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        methods : {

            /** Listagem dos Principais Contribuidores **/
            GetTopProfiles(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=ADVENTURE&ACTION=GET_TOP_PROFILES')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_top_profiles = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Listagem Aleatória dos Conteúdos **/
            GetContents(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=ADVENTURE&ACTION=GET_CONTENTS')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_contents = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Listagem Aleatória dos Conteúdos **/
            GetContentSubs(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=ADVENTURE&ACTION=GET_CONTENT_SUBS')

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_content_subs = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

        },

        /** Executo Determinados Métodos no Momento da Criação do Componente **/
        created(){

            this.GetTopProfiles();
            this.GetContents();
            this.GetContentSubs();
            console.log('Componente "AdventureDatagrid", montado com sucesso!')

        },

    }

</script>