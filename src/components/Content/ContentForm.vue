<template>

    <div>

        <div class="card-body">

            <!-- Verifico se possui mensagens retornadas do banco de dados -->
            <div v-if="query.message" class="mt-3 animate animate__fadeIn">

                <AlertQuery v-bind:class_name="form.class" v-bind:message="query.message"></AlertQuery>

            </div>

            <!-- Exibe a barra de progresso quando for verdadeiro-->
            <div v-if="form.progress_bar" class="mt-3 animate animate__fadeIn">

                <Progress percent="100"></Progress>

            </div>

            <div class="card shadow-sm animate animate__fadeIn" v-else>

                <div class="card-body">

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

                            <div class="col-md-4">

                                <div class="form-group">

                                    <select class="form-control custom-select" v-model="inputs.situation_id">

                                        <option value="0" selected>

                                            Situação

                                        </option>

                                        <option v-bind:value="result.situation_id" v-for="(result, index) in query.situations" v-bind:key="index">

                                            {{ result.name }}

                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <select class="form-control custom-select" v-model="inputs.content_category_id">

                                        <option value="0" selected>

                                            Categoria de Conteúdo

                                        </option>

                                        <option v-bind:value="result.content_category_id" v-for="(result, index) in query.content_categories" v-bind:key="index">

                                            {{ result.name }}

                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <input type="number" class="form-control" placeholder="Posição do Conteúdo" v-model="inputs.menu_position" value="0">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12" v-if="form.step === 1">

                        <div class="form-group text-right">

                            <button class="btn btn-primary" v-on:click="NextForm()" v-if="inputs.situation_id && inputs.content_category_id && inputs.menu_position">

                                Avançar

                            </button>

                            <button class="btn btn-primary disabled" v-else disabled>

                                Preencha todos os campos

                            </button>

                        </div>

                    </div>

                    <div class="col-md-12" v-if="form.step === 2">

                        <div class="alert alert-info alert-dismissible fade show" role="alert">

                            <strong>2º Parte:</strong> Dados Secundários

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    </div>

                    <div class="col-md-12" v-if="form.step === 2">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="URL" v-model="inputs.url">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Título" v-model="inputs.title">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Título do Menu" v-model="inputs.title_menu">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Descrição do Conteúdo" v-model="inputs.description">

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

                            <button class="btn btn-primary" v-on:click="NextForm()" v-if="inputs.title && inputs.description">

                                Avançar

                            </button>

                            <button class="btn btn-primary disabled" v-else disabled>

                                Preencha todos os campos

                            </button>

                        </div>

                    </div>

                    <div class="col-md-12" v-if="form.step === 3">

                        <div class="alert alert-info alert-dismissible fade show" role="alert">

                            <strong>3º Parte:</strong> Texto do Conteúdo

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    </div>

                    <div class="col-md-12" v-if="form.step === 3">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Conteúdo Resumido" v-model="inputs.content_resume">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Conteúdo Completo" v-model="inputs.content_complete">

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

                        <button class="btn btn-primary" v-on:click="Save()" v-if="inputs.situation_id && inputs.content_category_id && inputs.menu_position && inputs.title && inputs.description">

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

                    result             : [],
                    message            : null,
                    situations         : [],
                    content_categories : [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    content_id          : this.$route.params.content_id,
                    content_category_id : null,
                    situation_id        : null,
                    highlighter_id      : null,
                    menu_position       : null,
                    url                 : null,
                    title               : null,
                    title_menu          : null,
                    description         : null,
                    content_resume      : null,
                    content_complete    : null,

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
            ListContentCategory(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_CATEGORY&ACTION=DATAGRID',)

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.content_categories = response.data.result;

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
            Form(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT&ACTION=FORM', {inputs: this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.inputs = response.data.result;

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
                axios.post('router.php?TABLE=CONTENT&ACTION=SAVE', {inputs: this.inputs})

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
                                    this.$router.replace('/');

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
            this.ListContentCategory();
            /** Verifico se o relatório esta em edição **/
            if (this.$route.params.content_id > 0){

                this.Form();

            }

        }

    }

</script>