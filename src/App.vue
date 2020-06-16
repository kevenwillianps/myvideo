<template>

  <div id="app">

      <!-- Exibe a barra de progresso quando for verdadeiro-->
      <div class="container mt-3 animate animate__fadeIn" v-if="form.progress_bar">

          <div class="card shadow-sm">

              <div class="card-body">

                  <Progress percent="100"></Progress>

              </div>

          </div>

      </div>

      <div v-else-if="session.user_name">

          <div class="wrapper">

              <!-- Sidebar  -->
              <nav id="sidebar" class="shadow-sm">

                  <div class="sidebar-header text-center">

                      <h3>

                          Softwiki

                      </h3>

                  </div>

                  <ul class="list-unstyled components">

                      <p>

                          {{ session.user_name }} - {{ session.function_name }}

                      </p>

                      <li>

                          <router-link v-bind:to="{name : 'content-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                              <i class="far fa-folder-open mr-1"></i>Conteúdo

                          </router-link>

                      </li>

                      <li>

                          <router-link v-bind:to="{name : 'adventure-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                              <i class="fab fa-wpexplorer mr-1"></i>Explorar

                          </router-link>

                      </li>

                      <li>

                          <router-link v-bind:to="{name : 'users-details', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                              <i class="fas fa-user-circle mr-1"></i>Perfil

                          </router-link>

                      </li>

                      <li>

                          <a href="#">

                              <i class="fab fa-gratipay mr-1"></i>Salvos

                          </a>

                      </li>

                      <li class="active" v-if="session.user_function_id == 1">

                          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                              <i class="fas fa-cog mr-1"></i>Administrativo

                          </a>

                          <ul class="collapse list-unstyled" id="homeSubmenu">

                              <li>

                                  <router-link v-bind:to="{name : 'users-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      Usuários

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'content-category-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      Categorias

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'situation-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      Situações

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'highlighter-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      Marcador

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'user-function-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      Cargos

                                  </router-link>

                              </li>

                          </ul>

                      </li>

                      <li>

                          <router-link to="/">

                              <i class="fas fa-info-circle mr-1"></i>Sobre

                          </router-link>

                      </li>

                      <li>

                          <a href="#">

                              <i class="fas fa-bug mr-1"></i>Bugs

                          </a>

                      </li>

                  </ul>

                  <ul class="list-unstyled CTAs">

                      <li>

                          <a href="https://softwiki.com.br/" class="download" target="_blank">

                              Softwiki

                          </a>

                      </li>

                      <li>

                          <a type="button" class="article" v-on:click="DestroySession()">

                              <i class="fas fa-power-off mr-1"></i>Sair

                          </a>

                      </li>

                  </ul>

              </nav>

              <!-- Page Content  -->
              <div id="content">

                  <router-view></router-view>

              </div>

          </div>

      </div>

      <div v-else>

          <Login></Login>

      </div>

  </div>

</template>

<script type="text/ecmascript-6">

    import Login    from './components/Geral/Login'
    import axios    from 'axios'
    import Progress from './components/Geral/Progress';

    export default {

        name: 'App',

        components : {

            Login,
            Progress,

        },

        data(){

            return {

                form : {

                    progress_bar : false,
                    class        : null,
                    show_form    : false,
                    progressBar  : 0,

                },
                session : [],
                progress : {

                    show : true,

                },

            }

        },

        methods : {

            DestroySession(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=DESTROYSESSION')

                    .then(response => {

                        location.reload();
                        console.log(response);

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

            GetSession(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=GETSESSION')

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

        },

        mounted(){

            this.GetSession();
            console.log('Componente "App", montado com sucesso')

        }

    }

</script>
