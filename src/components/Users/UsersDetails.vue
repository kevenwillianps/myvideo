<template>

    <div>

        <h4>

            <i class="far fa-user-circle mr-1"></i>Perfil

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

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

        <div class="bg-white shadow-sm rounded overflow-hidden animate animate__fadeIn" v-else>

            <div class="px-4 pt-0 pb-4 bg-dark">

                <div class="media align-items-end profile-header">

                    <div class="profile mr-3">

                        <img v-bind:src="query.result_user.file_path + '/' + query.result_user.file_name" v-bind:alt="query.result_user.file_name" width="230" class="rounded mb-2 img-thumbnail">

                        <a type="button" class="btn btn-primary btn-sm btn-block text-white" v-on:click="EditForm(query.result_user.user_name, query.result_user.user_email)" v-if="!form.show_form">

                            Editar

                        </a>

                        <a type="button" class="btn btn-danger btn-sm btn-block text-white" v-on:click="ShowForm()" v-else>

                            Cancelar

                        </a>

                    </div>

                    <div class="media-body mb-5 text-white">

                        <h4 class="mt-0 mb-0">

                            {{ query.result_user.user_name }}

                        </h4>

                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i>

                            {{ query.result_user.user_function }}

                        </p>

                    </div>

                </div>

            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">

                <ul class="list-inline mb-0">

                    <li class="list-inline-item">

                        <h5 class="font-weight-bold mb-0 d-block">

                            {{ query.result_user.quantity_content }}

                        </h5>

                        <small class="text-muted">

                            <i class="fa fa-picture-o mr-1"></i>Playlits

                        </small>

                    </li>

                    <li class="list-inline-item">

                        <h5 class="font-weight-bold mb-0 d-block">

                            {{ query.result_user.quantity_content_sub }}

                        </h5>

                        <small class="text-muted">

                            <i class="fa fa-user-circle-o mr-1"></i>Publicações

                        </small>

                    </li>

                </ul>

            </div>

            <div class="py-4 px-4">

                <div v-show="form.show_form" class="mb-3">

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

                                                        <input type="password" class="form-control" placeholder="Senha" v-model="inputs.password">

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <input type="email" class="form-control" placeholder="Email" v-model="inputs.email">

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

                                                                    {{ inputs_file.name_auxiliary }}

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

                                            <button class="btn btn-default" v-on:click="Save()" v-if="inputs.name && inputs.email">

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

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <h5 class="mb-0">

                        Palylists

                    </h5>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-4" v-for="(result, index) in query.result_content" v-bind:key="index">

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

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <h5 class="mb-0">

                        Publicações

                    </h5>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-4" v-for="(result, index) in query.result_content_sub" v-bind:key="index">

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

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContentSub" aria-expanded="false" aria-label="Toggle navigation">

                                    <span class="navbar-toggler-icon"></span>

                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContentSub">

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

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import AlertInfo from '../Geral/AlertInfo';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "UsersDetails",

        data() {

            return {

                /** Controle do HTML **/
                form: {

                    progress_bar: false,
                    class: null,
                    show_form: false,
                    progressBar: 0,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result_user: [],
                    result_content: [],
                    result_content_sub: [],
                    user_functions: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    user_id: this.$route.params.user_id,
                    user_function_id: null,
                    situation_id: null,
                    name: null,
                    email: null,
                    date_birth: null,
                    access_first: null,
                    access_last: null,
                    access_log: null,
                    password: null,
                    date_register: null,

                },
                /** Grupo de variáveis que guardar os dados dos campos do arquivo **/
                inputs_file: {

                    name_auxiliary: null,
                    name: null,
                    file: null,
                    part: null,
                    length: 0,
                    extension: null,

                },
                /** Dados da Seção **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        components: {

            Progress,
            AlertInfo,
            ModalConfirm,

        },

        methods: {

            ShowForm() {

                if (this.form.show_form) {

                    this.form.show_form = false;
                    this.ResetForm();

                } else {

                    this.form.show_form = true;

                }

            },

            ResetForm() {

                this.inputs.user_id = this.$route.params.user_id;
                this.inputs.user_function_id = null;
                this.inputs.situation_id = null;
                this.inputs.name = null;
                this.inputs.email = null;
                this.inputs.date_birth = null;
                this.inputs.access_first = null;
                this.inputs.access_last = null;
                this.inputs.access_log = null;
                this.inputs.password = null;
                this.inputs.date_register = null;
                this.inputs.date_update = null;
                this.form.show_form = false;
                this.form.progress_bar = false;

            },

            ResetFormFile() {

                this.inputs_file.name_auxiliary = null;
                this.inputs_file.name = null;
                this.inputs_file.file = null;
                this.inputs_file.part = null;
                this.inputs_file.length = 0;
                this.inputs_file.extension = null;
                this.form.progressBar = 0;

            },

            /** Método para listar todos os registros **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=USER&ACTION=USER_SAVE', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                window.setTimeout(() => {

                                    if (this.inputs_file) {

                                        this.inputs.user_id = response.data.user_id;
                                        this.PrepareForm();

                                    } else {

                                        this.ResetForm();
                                        this.ResetFormFile();
                                        this.UserDetails();

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
            UserDetails() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER&ACTION=USER_DETAILS', {

                    inputs: this.inputs

                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_user = response.data.result_user;
                        this.query.result_content = response.data.result_content;
                        this.query.result_content_sub = response.data.result_content_sub;

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
            EditForm(name, email) {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Oculto o formulário **/
                this.form.show_form = false;

                window.setTimeout(() => {

                    this.inputs.name = name;
                    this.inputs.email = email;

                    /** Deixo a barra de progresso indisponivel **/
                    this.form.progress_bar = false;

                    /** Mostro o formulário **/
                    this.form.show_form = true;

                }, 1000);

            },

            /** Preparo o formulário para envio **/
            async PrepareForm() {

                /** Envio as requisições de acordo com o tamanho da array **/
                for (let i = 0; i < this.inputs_file.length; i++) {

                    await this.SendForm(this.inputs.user_id, this.inputs.situation_id, this.inputs_file.name, i, this.inputs_file.file[i], this.inputs_file.length, this.inputs_file.extension)

                        .then(() => {

                            this.CalculateProgressBar(i, (this.inputs_file.length - 1));

                        });

                }

                this.ResetForm();
                this.ResetFormFile();
                this.UserDetails();

            },

            /** Envio uma requisição para o servidor **/
            SendForm: async(user_id, situation_id, name, pointer, part, length, extension) => {

                return axios.post('router.php?TABLE=USER_FILE&ACTION=USER_FILE_SAVE', {
                    inputs: {
                        user_id: user_id,
                        situation_id: situation_id,
                        name: name,
                        pointer: pointer,
                        part: part,
                        length: length,
                        extension: extension
                    }
                });

            },

            /** Calculo a barra de progresso **/
            CalculateProgressBar(byteUploaded, length) {

                this.form.progressBar = (byteUploaded * 100) / length;

            },

            onChange(e) {

                /** Instâncimento de objeto para ler o conteúdo do arquivo ***/
                let fileReader = new FileReader();

                /** Leio o conteúdo do arquivo **/
                fileReader.readAsDataURL(e.target.files[0]);

                /** Pego o nome do arquivo **/
                this.inputs_file.name_auxiliary = e.target.files[0].name;

                /** Gero o nome que vai salvar no banco de dados **/
                this.inputs_file.name = 'myvideo_' + (btoa(Math.random())) + '.' + (e.target.files[0].name.substring(e.target.files[0].name.indexOf(".") + 1));

                /** Pego o tipo do arquivo **/
                this.inputs_file.extension = e.target.files[0].type;

                fileReader.onload = (e) => {

                    /** Particionar o base64 em Array **/
                    let localString = e.target.result.substring(e.target.result.indexOf(",") + 1);
                    let start = 0;
                    let end = 2097152;
                    let localArray = Array();
                    let part = null;

                    /** Executo de acordo com o tamanho do base64 **/
                    for (let i = 0; i < localString.length; i++) {

                        /** Preencho selecionando o que esta entre o valor inicial e final **/
                        part = localString.substring(start, end);

                        /** Verifico se cheguei ao final do base64, senão preencho as variáveis **/
                        if (part && part !== null) {

                            /** Coloca o trecho do base64 na última posição da array **/
                            localArray.push(part);

                            /** Crio um novo intervalo de valores **/
                            start = end;
                            end = end + 2097152;

                        }

                    }

                    /** Pego o tamanho da minha array **/
                    this.inputs_file.length = localArray.length;

                    /** Transfiro minha array **/
                    this.inputs_file.file = localArray;

                };

            },

        },

        mounted() {

            this.UserDetails();
            console.log('Componente "UsersDetails", montado com sucesso!');

        }

    }

</script>