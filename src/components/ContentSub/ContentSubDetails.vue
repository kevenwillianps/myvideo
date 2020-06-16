<template>

    <div class="row">

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="col-md-9">

            <h4 class="mt-3">

                <i class="fas fa-brain mr-1"></i>Publicação Principal

            </h4>

            <!-- Exibe a barra de progresso quando for verdadeiro-->
            <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm" v-else>

                <div class="d-flex" v-if="query.result_content.file_name && query.result_content.file_type === 'video/mp4'">

                    <video width="100%" controls class="rounded border-dashed">

                        <source v-bind:src="query.result_content.file_path + '/' + query.result_content.file_name" type="video/mp4">

                    </video>

                </div>

                <div class="d-flex" v-else-if="query.result_content.file_name">

                    <img v-bind:src="query.result_content.file_path + '/' + query.result_content.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="query.result_content.file_name">

                </div>

                <div class="card-body">

                    <div class="media">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-8">

                                    <h4 class="my-0">

                                        {{ query.result_content.title }}

                                    </h4>

                                </div>

                                <div class="col-md-12 mt-2">

                                    <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ query.result_content.content_sub_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ query.result_content.date_register }}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="media mt-3">

                        <img src="image/009-user.png" width="45px" class="mr-3" alt="...">

                        <div class="media-body">

                            <h4 class="my-0">

                                {{ query.result_content.user_name }}

                            </h4>

                            <h6 class="mt-0 text-muted">

                                {{ query.result_content.user_function }}

                            </h6>

                            <p style="font-size: 1.1rem">

                                {{ query.result_content.content_complete }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <h4 class="mt-3">

                <i class="far fa-comment mr-1"></i>Comentários

            </h4>

            <div class="card shadow-sm">

                <div class="card-body">

                    <ContentSubAuxiliaryDatagrid v-bind:user-id="session.user_id" v-bind:user-function-id="session.user_function_id" v-bind:content-id="inputs.content_id" v-bind:content-sub-id="inputs.content_sub_id"></ContentSubAuxiliaryDatagrid>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <h4 class="mt-3">

                <i class="fas fa-link mr-1"></i>Relacionados

            </h4>

            <!-- Exibe a barra de progresso quando for verdadeiro-->
            <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="row" v-else>

                <div class="col-md-12 mb-4" v-for="(result, index) in query.result" v-bind:key="index">

                    <div class="card shadow-sm" v-if="result.content_sub_id != inputs.content_sub_id">

                        <div class="card-body">

                            <div class="d-flex" v-if="result.file_name && result.file_type === 'video/mp4'">

                                <video width="100%" controls class="rounded border-dashed">

                                    <source v-bind:src="result.file_path + '/' + result.file_name" type="video/mp4">

                                </video>

                            </div>

                            <div class="d-flex" v-else-if="result.file_name">

                                <img v-bind:src="result.file_path + '/' + result.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="result.file_name">

                            </div>

                            <div class="media">

                                <div class="media-body">

                                    <h4 class="my-3">

                                        <strong>

                                            {{ result.title }}

                                        </strong>

                                    </h4>

                                    <div class="mt-1">

                                        <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ result.date_register }}</span> - <span class="text-muted">{{ result.user_name }}</span> - <span class="text-muted">{{ result.user_function }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <nav class="navbar navbar-expand-lg navbar-light bg-light card-footer card-footer-transparent">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#MenuContentSubDatagrid_' + result.content_sub_id" v-bind:aria-controls="'#MenuContentSubDatagrid_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'MenuContentSubDatagrid_' + result.content_sub_id">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-sub-details-auxiliary', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id, content_sub_id : result.content_sub_id}}" class="nav-link">

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

    import axios                       from 'axios';
    import Progress                    from '../Geral/Progress';
    import ModalConfirm                from '../Geral/ModalConfirm';
    import ContentSubAuxiliaryDatagrid from '../ContentSubAuxiliary/ContentSubAuxiliaryDatagrid'

    export default {

        name: "UsersDatagrid",

        components : {

            Progress,
            ModalConfirm,
            ContentSubAuxiliaryDatagrid,

        },

        data(){

            return{

                form : {

                    progress_bar : false,
                    class        : null,
                    show_form    : false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result         : [],
                    result_content : [],
                    message        : null,
                    count          : 0,

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    content_sub_id           : this.$route.params.content_sub_id,
                    content_id               : this.$route.params.content_id,
                    content_sub_auxiliary_id : null,
                    user_id                  : null,
                    situation_id             : 1,
                    menu_position            : 1,
                    highlighter_id           : 1,
                    url                      : 'Não Informado',
                    title                    : null,
                    title_menu               : 'Não Informado',
                    description              : 'Não Informado',
                    content_resume           : 'Não Informado',
                    content_complete         : null,
                    date_register            : null,
                    date_update              : null,

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

                }else{

                    this.form.show_form = true;

                }

            },

            ResetForm(){

                this.inputs.content_sub_id           = this.$route.params.content_sub_id;
                this.inputs.content_id               = this.$route.params.content_id;
                this.inputs.content_sub_auxiliary_id = null;
                this.inputs.user_id                  = null;
                this.inputs.situation_id             = 1;
                this.inputs.menu_position            = 1;
                this.inputs.highlighter_id           = 1;
                this.inputs.url                      = 'Não Informado';
                this.inputs.title                    = null;
                this.inputs.title_menu               = 'Não Informado';
                this.inputs.description              = 'Não Informado';
                this.inputs.content_resume           = 'Não Informado';
                this.inputs.content_complete         = null;
                this.inputs.date_register            = null;
                this.inputs.date_update              = null;
                this.form.show_form                  = false;

            },

            ResetFormFile(){

                this.inputs_file.name       = null;
                this.inputs_file.file       = null;
                this.inputs_file.part       = null;
                this.inputs_file.length     = 0;
                this.inputs_file.extension  = null;
                this.form.progressBar       = 0;

            },

            /** Listagem de Classes **/
            GetContent(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=GET_CONTENT', {inputs: this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_content = response.data.result;

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
            List(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=DATAGRID', {inputs : this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;
                        this.query.count  = response.data.result.length;

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
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=DELETE', {inputs : this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 1:

                                this.ResetForm();
                                window.setTimeout(() => {

                                    this.List();
                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            default:

                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

            /** Método para listar todos os registros **/
            Save(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=SAVE', {inputs: this.inputs})

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 1:

                                window.setTimeout(() => {

                                    if (this.inputs_file){

                                        this.inputs.content_sub_id = response.data.content_sub_id;
                                        this.PrepareForm();

                                    }else{

                                        this.ResetForm();
                                        this.List();

                                    }

                                }, 1000);
                                break;

                            default:

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

            },

            /** Listagem de Classes **/
            Form(content_sub_id){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;
                this.form.show_form    = false;

                this.inputs.content_sub_id = content_sub_id;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=EDIT_FORM', {inputs: this.inputs})

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

                    await this.SendForm(this.inputs.content_sub_id, this.inputs.situation_id, this.inputs_file.name, i, this.inputs_file.file[i], this.inputs_file.length, this.inputs_file.extension)

                        .then((response => {

                            this.CalculateProgressBar(i, (this.inputs_file.length - 1));
                            console.log(response.data.cod);

                        }));

                }

                this.ResetForm();
                this.ResetFormFile();
                this.List();

            },

            /** Envio uma requisição para o servidor **/
            SendForm : async (content_sub_id, situation_id, name, pointer, part, length, extension) => {

                return axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=SAVE', {inputs: {content_sub_id : content_sub_id, situation_id : situation_id, name : name, pointer : pointer, part : part, length : length, extension : extension}});

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
            this.GetContent();
            console.log('Componente "UsersDatagrid", montado com sucesso!')

        },

    }

</script>