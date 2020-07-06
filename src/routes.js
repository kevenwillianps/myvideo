/** Importação de componentes 'Geral' **/
import Home from './components/Geral/Home';

/** Importação dos componentes 'Users' **/
import UsersDatagrid from './components/Users/UsersDatagrid';
import UsersDetails from './components/Users/UsersDetails';
import UsersForm from './components/Users/UsersForm';

/** Importação dos componentes 'content_category' **/
import ContentCategoryDatagrid from './components/ContentCategory/ContentCategoryDatagrid';
import ContentCategoryForm from './components/ContentCategory/ContentCategoryForm';

/** Importação dos componentes 'content' **/
import ContentDatagrid from './components/Content/ContentDatagrid';
import ContentForm from './components/Content/ContentForm';

/** Importação dos componentes 'content_sub' **/
import ContentSubDatagrid from './components/ContentSub/ContentSubDatagrid';
import ContentSubForm from './components/ContentSub/ContentSubForm';
import ContentSubDetails from './components/ContentSub/ContentSubDetails';
import ContentSubDetailsAuxiliary from './components/ContentSub/ContentSubDetailsAuxiliary';

/** Importação dos componentes 'content_sub_auxiliary' **/
import ContentSubAuxiliaryDatagrid from './components/ContentSubAuxiliary/ContentSubAuxiliaryDatagrid';

/** Importação dos componentes 'situation' **/
import SituationDatagrid from './components/Situation/SituationDatagrid';
import SituationForm from './components/Situation/SituationForm';

/** Importação dos componentes 'highlighter' **/
import HighlighterDatagrid from './components/Highlighter/HighlighterDatagrid';
import HighlighterForm from './components/Highlighter/HighlighterForm';

/** Importação dos componentes 'user_function' **/
import UserFunctionDatagrid from './components/UserFunction/UserFunctionDatagrid';
import UserFunctionForm from './components/UserFunction/UserFunctionForm';

/** Importação dos componentes 'ADventure' **/
import AdventureDatagrid from './components/Adventure/AdventureDatagrid';

/** Importação dos componentes 'ADventure' **/
import SearchDatagrid from './components/Search/SearchDatagrid';
import SearchDatagridAuxiliary from './components/Search/SearchDatagridAuxiliary';

const routes = [

    {

        /** Página Inicial **/
        path: '/',
        component: Home,
        name: 'home',

    },

    {

        /** Listagem de Conteúdo **/
        path: '/content-datagrid/:user_id/:user_function_id',
        component: ContentDatagrid,
        name: 'content-datagrid',

    },
    {

        /** Listagem de Conteúdo **/
        path: '/content-form/:user_id/:user_function_id/:content_id',
        component: ContentForm,
        name: 'content-form',

    },

    {

        /** Listagem de SubConteúdos **/
        path: '/content-sub-datagrid/:user_id/:user_function_id/:content_id',
        component: ContentSubDatagrid,
        name: 'content-sub-datagrid',

    },

    {

        /** Listagem de SubConteúdos **/
        path: '/content-sub-form/:user_id/:user_function_id/:content_id/:content_sub_id',
        component: ContentSubForm,
        name: 'content-sub-form',

    },

    {

        /** Destalhes de Um SubConteúdo **/
        path: '/content-sub-details/:user_id/:user_function_id/:content_id/:content_sub_id',
        component: ContentSubDetails,
        name: 'content-sub-details',

    },

    {

        /** Detalhes de um SunConteúdoAuxiliar **/
        path: '/content-sub-details-auxiliary/:user_id/:user_function_id/:content_id/:content_sub_id',
        component: ContentSubDetailsAuxiliary,
        name: 'content-sub-details-auxiliary',

    },

    {

        /** Listagem de SubConteúdoAuxiliar **/
        path: '/content-sub-auxiliary-datagrid/:content_id/:content_sub_id',
        component: ContentSubAuxiliaryDatagrid,
        name: 'content-sub-auxiliary-datagrid',

    },

    {

        /** Listagem de Usuários **/
        path: '/users-datagrid/:user_id/:user_function_id',
        component: UsersDatagrid,
        name: 'users-datagrid',

    },

    {

        /** Listagem de Usuários **/
        path: '/users-form/:user_id/:user_function_id',
        component: UsersForm,
        name: 'users-form',

    },

    {

        /** Detalhes de um Usuário **/
        path: '/users-details/:user_id/:user_function_id',
        component: UsersDetails,
        name: 'users-details',

    },

    {

        /** Listagem de Categoria de Conteúdo **/
        path: '/content-category-datagrid/:user_id/:user_function_id',
        component: ContentCategoryDatagrid,
        name: 'content-category-datagrid',

    },

    {

        /** Listagem de Categoria de Conteúdo **/
        path: '/content-category-form/:user_id/:user_function_id/:content_category_id',
        component: ContentCategoryForm,
        name: 'content-category-form',

    },

    {

        /** Listagem de Situações **/
        path: '/situation-datagrid/:user_id/:user_function_id',
        component: SituationDatagrid,
        name: 'situation-datagrid',

    },

    {

        /** Listagem de Situações **/
        path: '/situation-form/:user_id/:user_function_id/:situation_id',
        component: SituationForm,
        name: 'situation-form',

    },

    {

        /** Listagem de Marcadores **/
        path: '/highlighter-datagrid/:user_id/:user_function_id',
        component: HighlighterDatagrid,
        name: 'highlighter-datagrid',

    },

    {

        /** Listagem de Marcadores **/
        path: '/highlighter-form/:user_id/:user_function_id/:highlighter_id',
        component: HighlighterForm,
        name: 'highlighter-form',

    },

    {

        /** Listagem de Funções de Usuário **/
        path: '/user-function-datagrid/:user_id/:user_function_id',
        component: UserFunctionDatagrid,
        name: 'user-function-datagrid',

    },

    {

        /** Listagem de Funções de Usuário **/
        path: '/user-function-form/:user_id/:user_function_id',
        component: UserFunctionForm,
        name: 'user-function-form',

    },

    {

        /** Explorar **/
        path: '/adventure-datagrid/:user_id/:user_function_id',
        component: AdventureDatagrid,
        name: 'adventure-datagrid',

    },

    {

        /** Explorar **/
        path: '/search-datagrid/:user_id/:user_function_id/:search',
        component: SearchDatagrid,
        name: 'search-datagrid',

    },

    {

        /** Explorar **/
        path: '/search-datagrid-auxiliary/:user_id/:user_function_id/:search',
        component: SearchDatagridAuxiliary,
        name: 'search-datagrid-auxiliary',

    },

];

export default routes;