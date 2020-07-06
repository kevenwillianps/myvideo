<template>

    <div>

        <ul class="list-unstyled">

            <li class="media" v-for="(result, index) in query.result" v-bind:key="index">

                <div class="media-body">

                    <div class="media">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-8">

                                    <h4 class="my-0">

                                        {{ result.title }}

                                    </h4>

                                </div>

                                <div class="col-md-12 mt-2">

                                    <span class="text-muted">

                                        <i class="fas fa-hashtag mr-1"></i>{{ result.content_sub_id }}

                                    </span> -

                                    <span class="text-muted">

                                        <i class="far fa-clock mr-1"></i> {{ result.date_register }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="media mt-3">

                        <img v-bind:src="result.user_file_path + '/' + result.user_file_name" v-bind:alt="result.user_file_name" width="64px" class="mr-3 rounded">

                        <div class="media-body">

                            <h4 class="my-0"> {{ result.user_name }} </h4>

                            <h6 class="mt-0 text-muted"> {{ result.user_function }} </h6>

                            <div class="card-text" style="font-size: 1.1rem;" v-html="result.content_complete"></div>

                            <div class="d-flex" v-if="result.file_name && result.file_type === 'video/mp4'">

                                <video height="250" controls class="mx-auto my-auto rounded border-dashed">

                                    <source v-bind:src="result.file_path + '/' + result.file_name" type="video/mp4">

                                </video>

                            </div>

                            <div class="d-flex" v-else-if="result.file_name">

                                <img v-bind:src="result.file_path + '/' + result.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="result.file_name">

                            </div>

                            <h6 class="mt-1">

                                <a class="nav-link badge badge-warning text-white mr-1 mt-1" type="button" v-on:click="EditForm(result.content_sub_id, result.content_id, result.content_sub_auxiliary_id, result.title, result.content_complete)" v-if="userId == result.user_id">

                                    <i class="fa fa-pencil-alt"></i> Editar

                                </a>

                                <a href="#" class="badge badge-danger text-white mr-1 mt-1" type="button" v-on:click="Delete(result.content_sub_id)" v-if="userId == result.user_id">

                                    <i class="fa fa-trash-alt"></i> Remover

                                </a>

                            </h6>

                        </div>

                    </div>

                    <hr>

                </div>

            </li>

        </ul>

        <div v-show="form.show_form" class="mt-3">

            <div class="card shadow-sm border-dashed animate animate__fadeIn">

                <div class="card-body">

                    <div class="media my-3">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Título" v-model="inputs.title">

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <ckeditor v-bind:editor="editor" v-model="inputs.content_complete" v-bind:config="editorConfig"></ckeditor>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <div class="border-dashed-default rounded">

                                            <div class="file-drop-area" v-if="!inputs_file.file">

                                                <span class="fake-btn mr-3">

                                                    Escolha seus arquivos

                                                </span>

                                                <span class="file-msg">

                                                    Arraste seus arquivos e solte até aqui para carregalos

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

                                <div class="col-md-12" v-if="inputs_file.name_auxiliary.length > 0">

                                    <div class="form-group">

                                        <table class="table table-bordered table-borderless border-dashed-table rounded shadow-sm">

                                            <thead>

                                            <tr>

                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Extensão</th>
                                                <th scope="col" class="text-center">Operações</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            <tr v-for="(result, index) in inputs_file.name_auxiliary" v-bind:key="index" class="border-top-dashed-table">

                                                <th scope="row" class="text-center">

                                                    {{ index }}

                                                </th>

                                                <td>

                                                    {{ result }}

                                                </td>

                                                <td>

                                                    {{ inputs_file.extension[index] }}

                                                </td>

                                                <td class="text-center">

                                                    <button class="btn btn-danger" v-on:click="RemoveFile(index)">

                                                        <i class="fas fa-fire-alt mr-1"></i>

                                                    </button>

                                                </td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <div class="col-md-12 text-right mt-3">

                                    <button class="btn btn-default" v-on:click="Save()" v-if="inputs.title && inputs.content_complete">

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

        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <a type="button" class="btn btn-dashed col-md-12 mt-1" v-on:click="ShowForm(), form.operation = 0">

            <i class="fas fa-comment mr-1"></i>{{ form.show_form ? 'Cancelar' : 'Responder' }}

        </a>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {

        name: "ContentSubAuxiliaryDatagrid",

        components: {

            Progress,

        },

        props: {

            contentSubId: null,
            contentId: null,
            userId: null,
            userFunctionId: null,

        },

        data() {

            return {

                editor: ClassicEditor,
                editorConfig: {},
                form: {

                    progress_bar: false,
                    class: null,
                    show_form: false,
                    operation: 0,

                },

                query: {

                    result: [],

                },

                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_sub_id: this.contentSubId,
                    content_id: this.contentId,
                    content_sub_auxiliary_id: this.contentSubId,
                    user_id: null,
                    situation_id: null,
                    menu_position: null,
                    highlighter_id: null,
                    url: null,
                    title: null,
                    title_menu: null,
                    description: null,
                    content_resume: null,
                    content_complete: null,
                    date_register: null,
                    date_update: null,

                },
                /** Grupo de variáveis que guardar os dados dos campos do arquivo **/
                inputs_file: {

                    name: [],
                    name_auxiliary: [],
                    part: [],
                    length: [],
                    extension: [],

                },
                /** Dados da Seção **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Habilito ou Desabilito o Formulário de Cadastro **/
            ShowForm() {

                if (this.form.show_form) {

                    this.form.show_form = false;
                    this.ResetForm();

                } else {

                    this.form.show_form = true;

                }

            },

            /** Adiciono ou removo um elemento da array **/
            RemoveFile(index) {

                /** Removo o elemento da array **/
                this.inputs_file.name_auxiliary.splice(index, 1);
                this.inputs_file.name.splice(index, 1);
                this.inputs_file.part.splice(index, 1);
                this.inputs_file.length.splice(index, 1);
                this.inputs_file.extension.splice(index, 1);

            },

            ResetForm() {

                this.inputs.content_sub_id = this.contentSubId;
                this.inputs.content_id = this.contentId;
                this.inputs.content_sub_auxiliary_id = this.contentSubId;
                this.inputs.user_id = null;
                this.inputs.situation_id = null;
                this.inputs.menu_position = null;
                this.inputs.highlighter_id = null;
                this.inputs.url = null;
                this.inputs.title = null;
                this.inputs.title_menu = null;
                this.inputs.description = null;
                this.inputs.content_resume = null;
                this.inputs.content_complete = null;
                this.inputs.date_register = null;
                this.inputs.date_update = null;

                this.form.show_form = false;
                this.form.progress_bar = false;

            },

            ResetFormFile() {

                this.inputs_file.name_auxiliary = [];
                this.inputs_file.name = [];
                this.inputs_file.part = [];
                this.inputs_file.length = [];
                this.inputs_file.extension = [];

            },

            /** Listagem de Classes **/
            List() {

                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB_AUXILIARY&ACTION=CONTENT_SUB_AUXILIARY_DATAGRID', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;
                        this.form.progress_bar = false;

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Exclusão de Classes **/
            Delete(content_sub_id) {

                this.inputs.content_sub_id = content_sub_id;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=CONTENT_SUB_AUXILIARY&ACTION=CONTENT_SUB_AUXILIARY_DELETE', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                this.List();
                                break;

                            default:

                                this.form.progress_bar = false;
                                break;

                        }

                    })

                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

            /** Método para listar todos os registros **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                if (this.form.operation == 0) {

                    this.inputs.content_sub_id = null;

                }

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=CONTENT_SUB_AUXILIARY&ACTION=CONTENT_SUB_AUXILIARY_SAVE', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                window.setTimeout(() => {

                                    if (this.inputs_file) {

                                        this.inputs.content_sub_id = response.data.content_sub_id;
                                        this.PrepareForm();

                                    } else {

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

            /** Edição de Registro **/
            EditForm(content_sub_id, content_id, content_sub_auxiliary_id, title, content_complete) {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;
                /** Desabilito o formulário **/
                this.form.show_form = false;

                /** Coloca os valores em edição **/
                this.inputs.content_sub_id = content_sub_id;
                this.inputs.content_id = content_id;
                this.inputs.content_sub_auxiliary_id = content_sub_auxiliary_id;
                this.inputs.title = title;
                this.inputs.content_complete = content_complete;

                /** Defino se é inclusão ou atualização **/
                this.form.operation = 1;

                /** Defino um delay no progresso **/
                setTimeout(() => {

                    /** Desabilito a Barra de Progresso **/
                    this.form.progress_bar = false;
                    /** Habilito o formulário **/
                    this.form.show_form = true;

                }, 300);

            },

            /** Preparo o formulário para envio **/
            async PrepareForm() {

                /** Envio as requisições de acordo com o tamanho da array **/
                for (let i = 0; i < this.inputs_file.part.length; i++) {

                    for (let j = 0; j < this.inputs_file.part[i].length; j++) {

                        /** Envio uma requisição para o servidor e aguardo uma resposta **/
                        await this.SendForm(this.inputs.content_sub_id, this.inputs.situation_id, this.inputs_file.name[i], j, this.inputs_file.part[i][j], this.inputs_file.part[i].length, this.inputs_file.extension[i]);

                    }

                }

                this.ResetForm();
                this.ResetFormFile();
                this.List();

            },

            /** Envio uma requisição para o servidor **/
            SendForm: async(content_sub_id, situation_id, name, pointer, part, length, extension) => {

                return axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=CONTENT_SUB_FILE_SAVE', {
                    inputs: {
                        content_sub_id: content_sub_id,
                        situation_id: situation_id,
                        name: name,
                        pointer: pointer,
                        part: part,
                        length: length,
                        extension: extension
                    }
                });

            },

            onChange(e) {

                /** Preparo o envio de múltiplos arquivos **/
                for (let i = 0; i < e.target.files.length; i++) {

                    /** Instâncimento de objeto para ler o conteúdo do arquivo ***/
                    let fileReader = new FileReader();

                    /** Leio o conteúdo do arquivo **/
                    fileReader.readAsDataURL(e.target.files[i]);

                    /** Pego o nome do arquivo **/
                    this.inputs_file.name_auxiliary.push(e.target.files[i].name);

                    /** Gero o nome que vai salvar no banco de dados **/
                    this.inputs_file.name.push('myvideo_' + (btoa(Math.random())) + '.' + (e.target.files[i].name.substring(e.target.files[i].name.indexOf(".") + 1)));

                    /** Pego o tipo do arquivo **/
                    this.inputs_file.extension.push(e.target.files[i].type);

                    fileReader.onload = (e) => {

                        /** Particionar o base64 em Array **/
                        let localString = e.target.result.split(',')[1];
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

                        /** Informo minha array de base64 particionada **/
                        this.inputs_file.part.push(localArray);

                        /** Informo tamnho da minha array **/
                        this.inputs_file.length.push(localArray.length);

                    };

                }

            },

        },

        created() {

            this.List();
            console.log('Componente "ContentSubAuxiliaryDatagrid", montado com sucesso!');

        },

    }

</script>