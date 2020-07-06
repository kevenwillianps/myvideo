<template>

    <div class="row">

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="col-md-9">

            <h4>

                <i class="far fa-folder-open mr-1"></i>Conteúdo

            </h4>

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

                        <img v-bind:src="query.result_content.user_file_path + '/' + query.result_content.user_file_name" v-bind:alt="query.result_content.user_file_name" width="64px" class="mr-3 rounded">

                        <div class="media-body">

                            <h4 class="my-0">

                                {{ query.result_content.user_name }}

                            </h4>

                            <h6 class="mt-0 text-muted">

                                {{ query.result_content.user_function }}

                            </h6>

                            <div class="card-text" v-html="query.result_content.content_complete"></div>

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

            <h4>

                <i class="fas fa-link mr-1"></i>Relacionados

            </h4>

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

                            <h4 class="card-title">

                                <strong>

                                    {{ result.title }}

                                </strong>

                            </h4>

                            <div class="mt-1">

                                <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ result.date_register }}</span> - <span class="text-muted">{{ result.user_name }}</span> - <span class="text-muted">{{ result.user_function }}</span>

                            </div>

                        </div>

                        <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

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

    /** Importação de Componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';
    import ContentSubAuxiliaryDatagrid from '../ContentSubAuxiliary/ContentSubAuxiliaryDatagrid'

    export default {

        /** Nome do componente atual **/
        name: "ContentSubDetails",

        /** Declaração de componentes **/
        components: {

            Progress,
            ModalConfirm,
            ContentSubAuxiliaryDatagrid,

        },

        data() {

            return {

                form: {

                    progress_bar: false,
                    show_form: false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],
                    result_content: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_sub_id: this.$route.params.content_sub_id,
                    content_id: this.$route.params.content_id,

                },
                /** Dados da Seção **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

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

            /** Listagem de Classes **/
            GetContent() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_GET_CONTENT', {
                    inputs: this.inputs
                })

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
            List() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_DATAGRID', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;
                        this.query.count = response.data.result.length;

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

        },

        created() {

            this.List();
            this.GetContent();
            console.log('Componente "ContentSubDetails", montado com sucesso!');

        },

    }

</script>