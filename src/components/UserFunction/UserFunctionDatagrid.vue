<template>

    <div>

        <h4>

            <i class="fas fa-check mr-1"></i>Cargos

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="card card-hover shadow-sm border border-dashed mb-3" v-if="session.user_function_id == 1">

            <div class="container">

                <div class="media m-4">

                    <div class="media-body">

                        <h3 class="mb-0 text-center">

                            <strong>

                                {{ form.show_form ? 'Cancelar Cadastro' : 'Novo Cargo' }}

                            </strong>

                        </h3>

                        <h5 class="mt-2 text-center">

                            <a href="#" v-on:click="ShowForm()" class="stretched-link text-decoration-none badge badge-light">

                                {{ form.show_form ? 'Clique para cancelar' : 'Clique para cadastrar' }}

                            </a>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

        <div v-show="form.show_form" class="mb-3" v-if="session.user_function_id == 1">

            <div class="card shadow-sm border-dashed animate animate__fadeIn">

                <div class="card-body">

                    <div class="media my-3">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Nome" v-model="inputs.name">

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Descrição" v-model="inputs.description">

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" id="c_execute" v-model="inputs.c_execute" v-bind:checked="inputs.c_execute">

                                                    <label class="custom-control-label" for="c_execute">

                                                        Criar

                                                    </label>

                                                </div>

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" id="r_execute" v-model="inputs.r_execute" v-bind:checked="inputs.r_execute">

                                                    <label class="custom-control-label" for="r_execute">

                                                        Executar

                                                    </label>

                                                </div>

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" id="u_execute" v-model="inputs.u_execute" v-bind:checked="inputs.u_execute">

                                                    <label class="custom-control-label" for="u_execute">

                                                        Atualizar

                                                    </label>

                                                </div>

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" id="d_execute" v-model="inputs.d_execute" v-bind:checked="inputs.d_execute">

                                                    <label class="custom-control-label" for="d_execute">

                                                        Remover

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12 text-right mt-3">

                                    <button class="btn btn-default" v-on:click="Save()" v-if="inputs.name && inputs.description">

                                        <i class="fas fa-paper-plane"></i> Salvar

                                    </button>

                                    <button class="btn btn-default disabled" v-else disabled>

                                        <i class="fas fa-paper-plane"></i> Salvar

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <hr>

        </div>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <!-- Se não Localizar registros, mostra um alerta -->
        <div class="mt-3 animate animate__fadeIn" v-else-if="query.result <= 0">

            <AlertInfo message="Não foram localizados registros"></AlertInfo>

        </div>

        <div v-else>

            <div class="card shadow-sm animate animate__fadeIn">

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

                                        <a type="button" class="badge badge-danger mr-1 mt-1 text-white" data-toggle="modal" data-target="#myModal" v-on:click="inputs.user_function_id = result.user_function_id">

                                            <i class="fas fa-fire-alt mr-1"></i>Excluir

                                        </a>

                                        <a type="button" class="badge badge-warning mr-1 mt-1 text-white" v-on:click="Form(result.user_function_id)">

                                            <i class="fas fa-pencil-alt mr-1"></i>Editar

                                        </a>

                                    </div>

                                    <div class="col-md-12">

                                        <p>

                                            {{ result.description }}

                                        </p>

                                        <span class="text-muted">

                                            <i class="fas fa-hashtag mr-1"></i>{{ result.user_function_id }}

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

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result         : [],
                    message        : null,
                    user_functions : [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    user_function_id : null,
                    situation_id     : null,
                    name             : null,
                    description      : null,
                    c_execute        : null,
                    r_execute        : null,
                    u_execute        : null,
                    d_execute        : null,

                },
                /** Dados da Seção **/
                session : {

                    user_id          : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        methods : {

            ShowForm(){

                if(this.form.show_form){

                    this.form.show_form = false;
                    this.ResetForm();

                }else{

                    this.form.show_form = true;

                }

            },

            ResetForm(){

                this.inputs.user_function_id = null;
                this.inputs.situation_id     = null;
                this.inputs.name             = null;
                this.inputs.description      = null;
                this.inputs.c_execute        = null;
                this.inputs.r_execute        = null;
                this.inputs.u_execute        = null;
                this.inputs.d_execute        = null;

                this.form.show_form          = false;
                this.form.progress_bar       = false;

            },

            /** Listagem de Classes **/
            Form(user_function_id){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;
                this.form.show_form    = false;

                this.inputs.user_function_id = user_function_id;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=EDIT_FORM', {inputs: this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.inputs = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;
                            this.form.show_form = true;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Método para listar todos os registros **/
            Save(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=SAVE', {inputs: this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 1:

                                this.List();
                                this.ResetForm();
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

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            },

            /** Listagem de Classes **/
            List(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=DATAGRID', {inputs : this.inputs})

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
            Delete(){

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=DELETE', {inputs : this.inputs})

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
