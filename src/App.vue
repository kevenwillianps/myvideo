<template>

    <div id="app">

        <div class="container mt-3 animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div v-else-if="session.user_name">

            <div class="wrapper">

                <nav id="sidebar" class="shadow-sm border-right">

                    <div class="sidebar-header text-center shadow-sm animate animate__fadeIn">

                        <img src="image/0001.png" width="30" class="d-inline-block align-top" alt="Softwiki Suporte Tecnlógico - Myvideo">

                    </div>

                    <ul class="list-unstyled components animate animate__fadeIn">

                        <li class="nav-item">

                            <router-link v-bind:to="{name : 'content-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="text-center nav-link">

                                <i class="far fa-folder-open"></i>

                                <br>

                                    <span class="small-side-menu">

                                    Conteúdo

                                </span>

                            </router-link>

                        </li>

                        <li class="nav-item">

                            <router-link v-bind:to="{name : 'adventure-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="text-center nav-link">

                                <i class="fab fa-wpexplorer"></i>

                                <br>

                                    <span class="small-side-menu">

                                    Explorar

                                </span>

                            </router-link>

                        </li>

                        <li class="nav-item">

                            <router-link v-bind:to="{name : 'users-details', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="text-center nav-link">

                                <i class="fas fa-user-circle"></i>

                                <br>

                                <span class="small-side-menu">

                                    Perfil

                                </span>

                            </router-link>

                        </li>

                        <li class="nav-item">

                            <a type="button" class="text-center nav-link">

                                <i class="fab fa-gratipay"></i>

                                <br>

                                <span class="small-side-menu">

                                    Salvos

                                </span>

                            </a>

                        </li>

                        <li class="nav-item">

                            <router-link to="/" class="text-center nav-link">

                                <i class="fas fa-info-circle"></i>

                                <br>

                                <span class="small-side-menu">

                                    Sobre

                                </span>

                            </router-link>

                        </li>

                        <li class="nav-item">

                            <a type="button" class="text-center nav-link">

                                <i class="fas fa-bug"></i>

                                <br>

                                <span class="small-side-menu">

                                    Bugs

                                </span>

                            </a>

                        </li>

                    </ul>

                    <ul class="list-unstyled CTAs">

                        <li>

                            <a href="https://softwiki.com.br" class="download" target="_blank">

                                Softwiki

                            </a>

                        </li>

                        <li>

                            <a href="http://kevenwillian.com.br" class="article" target="_blank">

                                Keven

                            </a>

                        </li>

                    </ul>

                </nav>

                <div id="content">

                    <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">

                        <div class="container-fluid">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContentSearch" aria-controls="navbarSupportedContentSearch" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContentSearch">

                                <div class="mr-2 my-auto w-100 d-inline-block">

                                    <div class="input-group">

                                        <input type="text" class="form-control border border-right-0" placeholder="Buscar..." v-model="inputs.search">

                                        <span class="input-group-append">

                                            <button class="btn btn-outline-dark border border-left-0" type="button" v-on:click="Search()">

                                                <i class="fa fa-search"></i>

                                            </button>

                                        </span>

                                    </div>

                                </div>

                                <ul class="navbar-nav ml-auto">

                                    <li class="nav-item dropdown dropleft">

                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            {{ session.user_name }}

                                        </a>

                                        <div class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">

                                            <div v-if="session.user_function_id == 1">

                                                <h6 class="dropdown-header">

                                                    Controle de Usuários

                                                </h6>

                                                <router-link v-bind:to="{name : 'users-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="dropdown-item">

                                                    Usuários

                                                </router-link>

                                                <router-link v-bind:to="{name : 'user-function-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="dropdown-item">

                                                    Cargos

                                                </router-link>

                                                <h6 class="dropdown-header">

                                                    Parâmetros

                                                </h6>

                                                <router-link v-bind:to="{name : 'content-category-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="dropdown-item">

                                                    Categorias

                                                </router-link>

                                                <router-link v-bind:to="{name : 'situation-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="dropdown-item">

                                                    Situações

                                                </router-link>

                                                <router-link v-bind:to="{name : 'highlighter-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="dropdown-item">

                                                    Marcadores

                                                </router-link>

                                                <div class="dropdown-divider"></div>

                                            </div>

                                            <a class="dropdown-item" type="button" v-on:click="DestroySession()">

                                                <i class="fas fa-power-off"></i> Sair

                                            </a>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </nav>

                    <div class="container-fluid mt-3">

                        <div v-if="query.result.content.length > 0 || query.result.content_sub.length > 0">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <h4>

                                                <i class="far fa-folder-open mr-1"></i>Resultados em PlayList

                                            </h4>

                                        </div>

                                        <div class="col-md-6 text-right">

                                            <button class="btn btn-default" v-on:click="Reset()">

                                                Limpar Busca

                                            </button>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3 mb-4" v-for="(result, index) in query.result.content" v-bind:key="index">

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

                                            <div class="media mt-2">

                                                <div class="media-body">

                                                    <h4 class="mb-0">

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

                                        <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

                                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                                                <span class="navbar-toggler-icon"></span>

                                            </button>

                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                                <ul class="navbar-nav mr-auto">

                                                    <li class="nav-item">

                                                        <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_id = result.content_id" v-if="session.user_id == result.user_id">

                                                            <i class="fas fa-fire-alt mr-1"></i>Excluir

                                                        </a>

                                                    </li>

                                                    <li class="nav-item">

                                                        <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id}}" class="nav-link" v-on:click="Reset()">

                                                            <i class="far fa-eye mr-1"></i>Ver

                                                        </router-link>

                                                    </li>

                                                </ul>

                                            </div>

                                        </nav>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">

                                    <h4>

                                        <i class="far fa-folder-open mr-1"></i>Resultados em Conteúdo

                                    </h4>

                                </div>

                                <div class="col-md-3 mb-4" v-for="(result, index) in query.result.content_sub" v-bind:key="index">

                                    <div class="card shadow-sm">

                                        <div class="card-body">

                                            <div class="d-flex" v-if="result.file_name && result.file_type === 'video/mp4'">

                                                <img v-bind:src="query.result_content.file_path + '/' + query.result_content.file_name" class="img-fluid mx-auto my-auto rounded border-dashed" v-bind:alt="query.result_content.file_name">

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

                                                <span class="text-muted">

                                                    <i class="fas fa-hashtag mr-1"></i>{{result.content_sub_id}}

                                                </span> -

                                                <span class="text-muted">

                                                    <i class="far fa-clock mr-1"></i>{{result.date_register}}

                                                </span> -

                                                <span class="text-muted">

                                                    {{result.user_name}}

                                                </span> -

                                                <span class="text-muted">

                                                    {{result.user_function}}

                                                </span>

                                            </div>

                                        </div>

                                        <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

                                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#MenuContentSubDatagrid_' + result.content_sub_id" v-bind:aria-controls="'#MenuContentSubDatagrid_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                                                <span class="navbar-toggler-icon"></span>

                                            </button>

                                            <div class="collapse navbar-collapse" v-bind:id="'MenuContentSubDatagrid_' + result.content_sub_id">

                                                <ul class="navbar-nav mr-auto">

                                                    <li class="nav-item">

                                                        <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_sub_id = result.content_sub_id" v-if="session.user_id == result.user_id">

                                                            <i class="fas fa-fire-alt mr-1"></i>Excluir

                                                        </a>

                                                    </li>

                                                    <li class="nav-item">

                                                        <router-link v-bind:to="{name : 'content-sub-details', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id, content_sub_id : result.content_sub_id}}" class="nav-link" v-on:click="Reset()">

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

                        <router-view></router-view>

                    </div>

                </div>

            </div>

        </div>

        <div v-else>

            <Login></Login>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios'
    import Login from './components/Geral/Login'
    import Progress from './components/Geral/Progress';

    export default {

        name: 'App',

        /** Declaração de componentes **/
        components: {

            Login,
            Progress,

        },

        data() {

            return {

                form: {

                    progress_bar: false,
                    show_form: false,

                },
                session: [],
                progress: {

                    show: true,

                },
                inputs: {

                    search: null,

                },
                query: {

                    result: {

                        content: [],
                        content_sub: [],

                    }

                }

            }

        },

        methods: {

            /** Encerro a sessão do usuário **/
            DestroySession() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=USER_DESTROY_SESSION')

                    .then(response => {

                        location.reload();
                        console.log(response);

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

            /** Crio a sessão do usuário **/
            GetSession() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=USER_GET_SESSION')

                    .then(response => {

                        /** Desabilito minha barra de progresso **/
                        this.session = response.data.result;
                        window.setTimeout(() => {

                            /** Habilito minha barra de progresso **/
                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

            /** Realizo a busca de conteúdo **/
            Search() {

                this.$router.replace({
                    name: this.$route.name === 'search-datagrid' ? 'search-datagrid-auxiliary' : 'search-datagrid',
                    params: {
                        user_id: this.session.user_id,
                        user_function_id: this.session.user_function_id,
                        search: this.inputs.search
                    }
                });

            },

        },

        /** Métodos executados quando o componente é montado **/
        mounted() {

            this.GetSession();

            /** Informo que o componente foi motando **/
            console.log('Componente "App", montado com sucesso')

        }

    }

</script>