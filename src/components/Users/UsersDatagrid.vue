<template>

    <div>

        <h4>

            <i class="fas fa-users mr-1"></i>Usuários

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="card card-hover shadow-sm border border-dashed mb-3" v-if="session.user_function_id == 1">

            <div class="container">

                <div class="media m-4">

                    <div class="media-body">

                        <h3 class="mb-0 text-center">

                            <strong>

                                {{ form.show_form ? 'Cancelar Cadastro' : 'Novo Usuário' }}

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

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Nome" v-model="inputs.name">

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <input type="date" class="form-control" placeholder="Data de Nascimento" v-model="inputs.date_birth">

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <input type="password" class="form-control" placeholder="Senha" v-model="inputs.password">

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <input type="email" class="form-control" placeholder="Email" v-model="inputs.email">

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

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <div class="border-dashed-default rounded">

                                            <div class="file-drop-area" v-if="!inputs_file.file">

                                                <span class="fake-btn mr-3">

                                                    Escolha a foto de perfil

                                                </span>

                                                <input class="file-input" type="file" v-on:change="onChange">

                                            </div>

                                            <div v-else>

                                                <div class="media">

                                                    <div class="media-body p-3">

                                                        <h3 class="mt-0">

                                                            {{ inputs_file.name }}

                                                        </h3>

                                                        <button class="btn btn-default" v-on:click="ResetFormFile()">

                                                            <i class="fas fa-eraser mr-1"></i> Remover Arquivo

                                                        </button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12 text-right mt-3">

                                    <button class="btn btn-default" v-on:click="Save()" v-if="inputs.name && inputs.date_birth && inputs.password && inputs.email && inputs.user_function_id">

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

                            <img v-bind:src="result.file_path + '/' + result.file_name" v-bind:alt="result.file_name" width="90px" height="85px" class="mr-3 rounded-circle">

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

                                        <p>

                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,

                                        </p>

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

                    name      : null,
                    file      : null,
                    part      : null,
                    length    : 0,
                    extension : null,

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

                this.inputs.user_id          = null;
                this.inputs.user_function_id = null;
                this.inputs.situation_id     = null;
                this.inputs.name             = null;
                this.inputs.email            = null;
                this.inputs.date_birth       = null;
                this.inputs.access_first     = null;
                this.inputs.access_last      = null;
                this.inputs.access_log       = null;
                this.inputs.password         = null;
                this.inputs.date_register    = null;
                this.inputs.date_update      = null;
                this.form.show_form          = false;
                this.form.progress_bar       = false;

            },

            ResetFormFile(){

                this.inputs_file.name       = null;
                this.inputs_file.file       = null;
                this.inputs_file.part       = null;
                this.inputs_file.length     = 0;
                this.inputs_file.extension  = null;
                this.form.progressBar       = 0;

            },

            /** Método para listar todos os registros **/
            Save(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=USER&ACTION=SAVE', {inputs: this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 1:

                                window.setTimeout(() => {

                                    if (this.inputs_file){

                                        this.inputs.user_id = response.data.user_id;
                                        this.PrepareForm();

                                    }else{

                                        this.ResetForm();
                                        this.ResetFormFile();
                                        this.List();

                                    }

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
                axios.post('router.php?TABLE=USER&ACTION=DATAGRID', {inputs : this.inputs})

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

            /** Exclusão de Classes **/
            Delete(){

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=USER&ACTION=DELETE', {inputs : this.inputs})

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

            /** Listagem de Classes **/
            Form(user_id){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;
                this.form.show_form    = false;

                this.inputs.user_id = user_id;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER&ACTION=EDIT_FORM', {inputs: this.inputs})

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

            /** Preparo o formulário para envio **/
            async PrepareForm(){

                /** Envio as requisições de acordo com o tamanho da array **/
                for (let i = 0; i < this.inputs_file.length; i++){

                    await this.SendForm(this.inputs.content_id, this.inputs.situation_id, this.inputs_file.name, i, this.inputs_file.file[i], this.inputs_file.length, this.inputs_file.extension)

                        .then(() => {

                            this.CalculateProgressBar(i, (this.inputs_file.length - 1));

                        });

                }

                this.ResetForm();
                this.ResetFormFile();
                this.List();

            },

            /** Envio uma requisição para o servidor **/
            SendForm : async (content_id, situation_id, name, pointer, part, length, extension) => {

                return axios.post('router.php?TABLE=CONTENT_FILE&ACTION=SAVE', {inputs: {content_id : content_id, situation_id : situation_id, name : name, pointer : pointer, part : part, length : length, extension : extension}});

            },

            /** Calculo a barra de progresso **/
            CalculateProgressBar(byteUploaded, length){

                this.form.progressBar = (byteUploaded * 100) / length;

            },

            onChange(e) {

                /** Instâncimento de objeto para ler o conteúdo do arquivo ***/
                let fileReader = new FileReader();

                /** Leio o conteúdo do arquivo **/
                fileReader.readAsDataURL(e.target.files[0]);

                /** Pego o nome do arquivo **/
                this.inputs_file.name      = e.target.files[0].name;

                /** Pego o tipo do arquivo **/
                this.inputs_file.extension = e.target.files[0].type;

                fileReader.onload = (e) => {

                    /** Particionar o base64 em Array **/
                    let localString = e.target.result.substring(e.target.result.indexOf(",") + 1);
                    let start       = 0;
                    let end         = 2097152;
                    let localArray  = Array();
                    let part        = null;

                    /** Executo de acordo com o tamanho do base64 **/
                    for (let i = 0; i < localString.length; i++){

                        /** Preencho selecionando o que esta entre o valor inicial e final **/
                        part = localString.substring(start, end);

                        /** Verifico se cheguei ao final do base64, senão preencho as variáveis **/
                        if (part && part !== null){

                            /** Coloca o trecho do base64 na última posição da array **/
                            localArray.push(part);

                            /** Crio um novo intervalo de valores **/
                            start = end;
                            end   = end + 2097152;

                        }

                    }

                    /** Pego o tamanho da minha array **/
                    this.inputs_file.length = localArray.length;

                    /** Transfiro minha array **/
                    this.inputs_file.file   = localArray;

                };

            },

        },

        created(){

            this.List();
            this.ListUserFunctions();
            console.log('Componente "UsersDatagrid", montado com sucesso!')

        },

    }

</script>
