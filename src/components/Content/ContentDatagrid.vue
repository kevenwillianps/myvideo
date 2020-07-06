<template>

    <div>

        <h4>

            <i class="far fa-folder-open mr-1"></i>Conteúdo

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="card card-hover shadow-sm border border-dashed" v-if="session.user_function_id == 1">

            <div class="container">

                <div class="media m-4">

                    <div class="media-body">

                        <h3 class="mb-0 text-center">

                            <strong>

                                Nova publicação

                            </strong>

                        </h3>

                        <h5 class="mt-2 text-center">

                            <router-link v-bind:to="{name : 'content-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : 0}}" class="stretched-link text-decoration-none badge badge-light">

                                Clique para cadastrar

                            </router-link>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div class="mt-3 animate animate__fadeIn" v-else-if="query.result <= 0">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="media">

                        <img src="image/svg/003-error.svg" width="70px" class="mr-3" alt="MyCMS - Keven Willian">

                        <div class="media-body">

                            <h3 class="mt-0">

                                Oooops!

                            </h3>

                            <h5 class="text-muted">

                                Não foram localizado registros

                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-3 animate animate__fadeIn" v-else>

            <div class="row">

                <div class="col-md-3 mb-4" v-for="(result, index) in query.result" v-bind:key="index">

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

                                        <router-link class="nav-link" v-bind:to="{name : 'content-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id}}">

                                            <i class="fas fa-pencil-alt mr-1"></i>Editar

                                        </router-link>

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

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de Componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        /** Nome do Componente Atual **/
        name: "ContentDatagrid",

        /** Declaração de Componentes **/
        components: {

            Progress,
            ModalConfirm,

        },

        data() {

            return {

                /** Grupo de variaveis para o controle de exibição **/
                form: {

                    progress_bar: false,

                },
                /** Grupo de variaveis para consultas sql's **/
                query: {

                    result: [],
                    message: null,

                },
                /** Grupo de variaveis para campos do formulário **/
                inputs: {

                    content_id: null,
                    title: null,
                    content_complete: null,

                },
                /** Grupo de variaveis da sessão do usuário **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Listagem de Classes **/
            List() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;

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

            /** Exclusão de Classes **/
            Delete() {

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_DELETE', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            /** Sucesso **/
                            case 1:

                                /** Defino um delay no progresso **/
                                setTimeout(() => {

                                    this.List();
                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            default:

                                /** Defino um delay no progresso **/
                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha Falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

        },

        mounted() {

            this.List();
            console.log('Componente "ContentDatagrid", montado com sucesso!');

        },

    }

</script>
