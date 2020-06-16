<template>

    <div>

        <nav class="navbar navbar-light navbar-expand-md bg-light justify-content-center bg-white border-bottom-color shadow-sm border-top">

            <div class="container">

                <button class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#collapsingNavbar2">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="navbar-collapse collapse justify-content-between align-items-center w-100 animate animate__fadeIn" id="collapsingNavbar2">

                    <ul class="navbar-nav mx-auto text-center">

                        <li class="nav-item mr-3">

                            <router-link to="/users-datagrid/" class="nav-link" href="#">

                                <i class="fas fa-backward mr-1"></i>Voltar

                            </router-link>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <div class="container">

            <div class="card text-white text-center shadow-sm border-0 mt-3 background-gradient animate animate__fadeIn">

                <div class="card-body">

                    <h6 class="card-title mb-0">

                        Formulário de

                    </h6>

                    <h3 class="mt-0">

                        Usuário

                    </h3>

                </div>

            </div>

            <!-- Verifico se possui mensagens retornadas do banco de dados -->
            <div v-if="query.message" class="mt-3 animate animate__fadeIn">

                <AlertQuery v-bind:class_name="form.class" v-bind:message="query.message"></AlertQuery>

            </div>

            <!-- Exibe a barra de progresso quando for verdadeiro-->
            <div v-if="form.progress_bar" class="mt-3 animate animate__fadeIn">

                <Progress percent="100"></Progress>

            </div>

            <div class="card shadow-sm animate animate__fadeIn mt-3" v-else>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12" v-if="form.step === 1">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">

                                <strong>1º Parte:</strong> Dados Principais

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 1">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Nome" v-model="inputs.name"/>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="email" class="form-control" placeholder="Email" v-model="inputs.email"/>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <input type="date" class="form-control" placeholder="Data de Nascimento" v-model="inputs.date_birth"/>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 1">

                            <div class="form-group text-right">

                                <button class="btn btn-primary" v-on:click="NextForm()" v-if="inputs.name">

                                    Avançar

                                </button>

                                <button class="btn btn-primary disabled" v-else disabled>

                                    Preencha todos os campos

                                </button>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 2">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">

                                <strong>1º Parte:</strong> Dados Principais

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 2">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <select class="form-control custom-select" v-model="inputs.situation_id">

                                            <option value="0" selected>Situação</option>
                                            <option v-bind:value="result.situation_id" v-for="(result, index) in query.situations" v-bind:key="index">

                                                {{ result.name }}

                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <select class="form-control custom-select" v-model="inputs.user_function_id">

                                            <option value="0" selected>Função</option>
                                            <option v-bind:value="result.user_function_id" v-for="(result, index) in query.user_functions" v-bind:key="index">

                                                {{ result.name }}

                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6" v-if="form.step === 2">

                            <div class="form-group text-left">

                                <button class="btn btn-primary" v-on:click="PrevForm()">

                                    Voltar

                                </button>

                            </div>

                        </div>

                        <div class="col-md-6" v-if="form.step === 2">

                            <div class="form-group text-right">

                                <button class="btn btn-primary" v-on:click="NextForm()" v-if="inputs.name">

                                    Avançar

                                </button>

                                <button class="btn btn-primary disabled" v-else disabled>

                                    Preencha todos os campos

                                </button>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 3">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">

                                <strong>2º Parte:</strong> Dados Secundários

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                        </div>

                        <div class="col-md-12" v-if="form.step === 3">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <input type="password" class="form-control" placeholder="Senha" v-model="inputs.password"/>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6" v-if="form.step === 3">

                            <div class="form-group text-left">

                                <button class="btn btn-primary" v-on:click="PrevForm()">

                                    Voltar

                                </button>

                            </div>

                        </div>

                        <div class="col-md-6 text-right" v-if="form.step === 3">

                            <button class="btn btn-primary" v-on:click="Save()" v-if="inputs.name && inputs.email && inputs.date_birth && inputs.password">

                                <i class="fas fa-paper-plane-o"></i> Salvar

                            </button>

                            <button class="btn btn-primary disabled" v-else disabled>

                                Preencha todos os campos

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios      from 'axios';
    import Progress   from '../Geral/Progress'
    import AlertQuery from '../Geral/AlertQuery';

    export default {

        name: "ClassForm",

        components : {

            Progress,
            AlertQuery,

        },

        data(){

            return{

                form : {

                    step         : 1,
                    progress_bar : false,
                    class        : null,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result         : [],
                    message        : null,
                    situations     : [],
                    user_functions : [],

                },
                route : {

                    project_id : this.$route.params.project_id,

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    user_function_id : null,
                    situation_id     : null,
                    name             : null,
                    email            : null,
                    date_birth       : null,
                    password         : null,

                },

            }

        },

        methods :{

            PrevForm(){

                this.form.step--;

            },

            NextForm(){

                this.form.step++;

            },

            /** Listagem de Classes **/
            ListSituations(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=SITUATION&ACTION=DATAGRID',)

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.situations = response.data.result;

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

            /** Listagem de Classes **/
            ListUserFunctions(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.user_functions = response.data.result;

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

            /** Método para listar todos os registros **/
            Save(){

                /** Limpo minhas mensagens de erros **/
                this.query.message     = null;
                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=USER&ACTION=SAVE', {inputs: this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 0 :

                                this.query.message = response.data.message;
                                this.form.class    = 'danger';
                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            case 1:

                                this.query.message = response.data.message;
                                this.form.class    = 'success';
                                window.setTimeout(() => {

                                    this.form.progress_bar = false;
                                    this.$router.replace('/users-datagrid/');

                                }, 1000);
                                break;

                            case  3:

                                this.query.message = response.data.message_sql;
                                this.form.class    = 'danger';
                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            }

        },

        mounted(){

            this.ListSituations();
            this.ListUserFunctions();

        }

    }

</script>