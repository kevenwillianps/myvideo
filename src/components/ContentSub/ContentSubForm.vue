<template>

    <div>

        <h4>

            <i class="far fa-folder-open mr-1"></i>Conteúdo

        </h4>

        <div class="card card-hover shadow-sm border border-dashed" v-if="session.user_function_id == 1">

            <div class="container">

                <div class="media m-4">

                    <div class="media-body">

                        <h3 class="mb-0 text-center">

                            <strong>

                                Cancelar publicação

                            </strong>

                        </h3>

                        <h5 class="mt-2 text-center">

                            <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : inputs.content_id}}" class="stretched-link text-decoration-none badge badge-light">

                                Clique para cancelar

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

        <div class="card shadow-sm border-dashed animate animate__fadeIn mt-3" v-else>

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

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {

        /** Nome do componente atual **/
        name: "ContentForm",

        /** Declaração de Componentes **/
        components: {

            Progress,

        },

        data() {

            return {

                editor: ClassicEditor,
                editorConfig: {},
                form: {

                    progress_bar: false,
                    show_form: false,

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_sub_id: this.$route.params.content_sub_id,
                    content_id: this.$route.params.content_id,
                    content_sub_auxiliary_id: null,
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
                /** Grupo de variaveis da sessão do usuário **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Adiciono ou removo um elemento da array **/
            RemoveFile(index) {

                /** Removo o elemento da array **/
                this.inputs_file.name_auxiliary.splice(index, 1);
                this.inputs_file.name.splice(index, 1);
                this.inputs_file.part.splice(index, 1);
                this.inputs_file.length.splice(index, 1);
                this.inputs_file.extension.splice(index, 1);

            },

            /** Busco o 'Conteúdo' **/
            EditForm() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_EDIT_FORM', {
                    inputs: this.inputs
                })

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
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_SAVE', {
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

                                        this.$router.replace({
                                            name: 'content-sub-datagrid',
                                            params: {
                                                user_id: this.session.user_id,
                                                user_function_id: this.session.user_function_id,
                                                content_id: this.$route.params.content_id
                                            }
                                        });

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

            /** Preparo o formulário para envio **/
            async PrepareForm() {

                /** Envio as requisições de acordo com o tamanho da array **/
                for (let i = 0; i < this.inputs_file.part.length; i++) {

                    for (let j = 0; j < this.inputs_file.part[i].length; j++) {

                        await this.SendForm(this.inputs.content_sub_id, this.inputs.situation_id, this.inputs_file.name[i], j, this.inputs_file.part[i][j], this.inputs_file.part[i].length, this.inputs_file.extension[i]);

                    }

                }

                this.$router.replace({
                    name: 'content-sub-datagrid',
                    params: {
                        user_id: this.session.user_id,
                        user_function_id: this.session.user_function_id,
                        content_id: this.$route.params.content_id
                    }
                });

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

        mounted() {

            /** Verifico se é edição **/
            if (this.$route.params.content_sub_id > 0) {

                this.EditForm();

            }
            console.log("Componente 'ContentForm', montado com sucesso!");

        }

    }

</script>