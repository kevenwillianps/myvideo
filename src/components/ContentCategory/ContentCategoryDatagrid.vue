<template>

    <div>

        <h4>

            <i class="fas fa-check mr-1"></i>Categoria de Conteúdo

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="card card-hover shadow-sm border border-dashed" v-if="session.user_function_id == 1">

            <div class="container">

                <div class="media m-4">

                    <div class="media-body">

                        <h3 class="mb-0 text-center">

                            <strong>

                                Cadastrar nova categoria

                            </strong>

                        </h3>

                        <h5 class="mt-2 text-center">

                            <router-link v-bind:to="{name : 'content-category-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_category_id : 0}}" class="stretched-link text-decoration-none badge badge-light">

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

        <div class="card shadow-sm animate animate__fadeIn mt-3" v-else>

            <div class="card-body">

                <ul class="list-unstyled">

                    <li class="media" v-for="(result, index) in query.result" v-bind:key="index">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-8">

                                    <h5 class="mt-0 mb-0">

                                        {{ result.name }}

                                    </h5>

                                </div>

                                <div class="col-md-4 text-right">

                                    <a type="button" class="badge badge-danger mr-1 mt-1 text-white" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_category_id = result.content_category_id">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </a>

                                    <router-link v-bind:to="{name : 'content-category-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_category_id : result.content_category_id}}" type="button" class="badge badge-warning mr-1 mt-1 text-white">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </router-link>

                                </div>

                                <div class="col-md-12">

                                    <p>

                                        {{ result.description }}

                                    </p>

                                    <span class="text-muted">

                                        <i class="fas fa-hashtag mr-1"></i>{{ result.content_category_id }}

                                    </span> -

                                    <span class="text-muted">

                                       <i class="far fa-clock mr-1"></i>{{ result.date_register }}

                                    </span>

                                </div>

                            </div>

                            <hr>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "ContentCategoryDatagrid",

        components: {

            Progress,
            ModalConfirm,

        },

        data() {

            return {

                /** Controle do HTML **/
                form: {

                    progress_bar: false,
                    class: null,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],
                    message: null,
                    user_functions: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_category_id: null,
                    situation_id: null,
                    name: null,
                    description: null,
                    date_register: null,
                    date_update: null,

                },
                /** Dados da Seção **/
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
                axios.post('router.php?TABLE=CONTENT_CATEGORY&ACTION=CONTENT_CATEGORY_DATAGRID')

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
                axios.post('router.php?TABLE=CONTENT_CATEGORY&ACTION=CONTENT_CATEGORY_DELETE', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                this.List();
                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            default:

                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

        },

        created() {

            this.List();
            console.log('Componente "ContentCategoryDatagrid", montado com sucesso!')

        },

    }

</script>
