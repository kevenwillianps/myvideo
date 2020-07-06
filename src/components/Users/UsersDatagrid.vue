<template>

    <div>

        <h4>

            <i class="fas fa-users mr-1"></i>Usuários

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

                            <router-link v-bind:to="{name : 'users-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : 0}}" class="stretched-link text-decoration-none badge badge-light">

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

            <AlertInfo message="Não foram localizados registros"></AlertInfo>

        </div>

        <div class="mt-3 card shadow-sm animate animate__fadeIn" v-else>

            <div class="card-body">

                <ul class="list-unstyled">

                    <li class="media" v-for="(result, index) in query.result" v-bind:key="index">

                        <img v-bind:src="result.file_path + '/' + result.file_name" v-bind:alt="result.file_name" width="64px" class="mr-3 rounded">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-8">

                                    <h5 class="mt-0 mb-0">

                                        {{ result.user_name }}

                                    </h5>

                                    <h6 class="mt-0 mb-1 text-muted">

                                        {{ result.user_function }}

                                    </h6>

                                </div>

                                <div class="col-md-4 text-right">

                                    <a type="button" class="badge badge-danger mr-1 mt-1 text-white" data-toggle="modal" data-target="#myModal" v-on:click="inputs.user_id = result.user_id">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </a>

                                    <a type="button" class="badge badge-warning mr-1 mt-1 text-white" v-on:click="Form(result.user_id)">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </a>

                                </div>

                                <div class="col-md-12">

                                        <span class="text-muted">

                                            <i class="fas fa-hashtag mr-1"></i>{{ result.user_id }}

                                        </span> -

                                    <span class="text-muted">

                                            <i class="far fa-clock mr-1"></i> {{ result.date_register }}

                                        </span> -

                                    <span class="text-muted">

                                            <i class="fas fa-birthday-cake mr-1"></i>{{ result.date_birth }}

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

    import axios        from 'axios';
    import AlertInfo    from '../Geral/AlertInfo';
    import Progress     from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "UsersDatagrid",

        components : {

            Progress,
            AlertInfo,
            ModalConfirm,

        },

        data(){

            return{

                /** Controle do HTML **/
                form : {

                    progress_bar : false,
                    class        : null,
                    show_form    : false,
                    progressBar  : 0,
                    search       : null,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result : [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    user_id          : null,
                    user_function_id : null,
                    situation_id     : null,
                    name             : null,
                    email            : null,
                    date_birth       : null,
                    access_first     : null,
                    access_last      : null,
                    access_log       : null,
                    password         : null,
                    date_register    : null,

                },
                /** Grupo de variáveis que guardar os dados dos campos do arquivo **/
                inputs_file : {

                    name_auxiliary : null,
                    name           : null,
                    file           : null,
                    part           : null,
                    length         : 0,
                    extension      : null,

                },
                /** Dados da Seção **/
                session : {

                    user_id          : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        methods : {

            /** Listagem de Classes **/
            List(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER&ACTION=USER_DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;

                        /** Defino um delay no progresso **/
                        window.setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Exclusão de Classes **/
            Delete(){

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=USER&ACTION=USER_DELETE', {inputs : this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

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

        created(){

            this.List();
            console.log('Componente "UsersDatagrid", montado com sucesso!')

        },

    }

</script>
