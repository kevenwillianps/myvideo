import Home from './components/Geral/Home';

/** Importo o componente da inicial: "Home" **/
import UsersDatagrid from './components/Users/UsersDatagrid';
import UsersForm     from './components/Users/UsersForm';
import UsersDetails  from './components/Users/UsersDetails';

/** Componente do: 'CategoriaDeConteudo' **/
import ContentCategoryDatagrid from './components/ContentCategory/ContentCategoryDatagrid';
import ContentCategoryForm     from './components/ContentCategory/ContentCategoryForm';

/** Componente do: 'Conteúdo' **/
import ContentDatagrid from './components/Content/ContentDatagrid';
import ContentForm     from './components/Content/ContentForm';

/** Componente do: 'COnteúdoVinculado' **/
import ContentSubDatagrid         from './components/ContentSub/ContentSubDatagrid';
import ContentSubForm             from './components/ContentSub/ContentSubForm';
import ContentSubDetails          from './components/ContentSub/ContentSubDetails';
import ContentSubDetailsAuxiliary from './components/ContentSub/ContentSubDetailsAuxiliary';

/** Componente do: 'ConteúdoSubAuxiliar' **/
import ContentSubAuxiliaryDatagrid from './components/ContentSubAuxiliary/ContentSubAuxiliaryDatagrid';
import ContentSubAuxiliaryForm     from './components/ContentSubAuxiliary/ContentSubAuxiliaryForm';

import SituationDatagrid           from './components/Situation/SituationDatagrid';
import HighlighterDatagrid         from './components/Highlighter/HighlighterDatagrid';
import UserFunctionDatagrid        from './components/UserFunction/UserFunctionDatagrid';

import AdventureDatagrid        from './components/Adventure/AdventureDatagrid';

const routes = [

    {

        path      : '/',
        component : Home,
        name      : 'home',

    },
    {

        path      : '/content-datagrid/:user_id/:user_function_id',
        component : ContentDatagrid,
        name      : 'content-datagrid',

    },

    {

        path      : '/users-datagrid/:user_id/:user_function_id',
        component : UsersDatagrid,
        name      : 'users-datagrid',

    },

    {

        path      : '/users-form/',
        component : UsersForm,
        name      : 'users-form',

    },

    {

        path      : '/users-details/:user_id/:user_function_id',
        component : UsersDetails,
        name      : 'users-details',

    },

    {

        path      : '/content-category-datagrid/:user_id/:user_function_id',
        component : ContentCategoryDatagrid,
        name      : 'content-category-datagrid',

    },

    {

        path      : '/content-category-form/',
        component : ContentCategoryForm,
        name      : 'content-category-form',

    },

    {

        path      : '/content-form/',
        component : ContentForm,
        name      : 'content-form',

    },

    {

        path      : '/content-edit-form/:content_id',
        component : ContentForm,
        name      : 'content-edit-form',

    },

    {

        path      : '/content-sub-datagrid/:user_id/:user_function_id/:content_id',
        component : ContentSubDatagrid,
        name      : 'content-sub-datagrid',

    },

    {

        path      : '/content-sub-form/:content_id',
        component : ContentSubForm,
        name      : 'content-sub-form',

    },

    {

        path      : '/content-sub-details/:user_id/:user_function_id/:content_id/:content_sub_id',
        component : ContentSubDetails,
        name      : 'content-sub-details',

    },

    {

        path      : '/content-sub-details-auxiliary/:user_id/:user_function_id/:content_id/:content_sub_id',
        component : ContentSubDetailsAuxiliary,
        name      : 'content-sub-details-auxiliary',

    },

    {

        path      : '/content-sub-auxiliary-form/:content_id/:content_sub_id',
        component : ContentSubAuxiliaryForm,
        name      : 'content-sub-auxiliary-form',

    },

    {

        path      : '/content-sub-auxiliary-datagrid/:content_id/:content_sub_id',
        component : ContentSubAuxiliaryDatagrid,
        name      : 'content-sub-auxiliary-datagrid',

    },

    {

        path      : '/situation-datagrid/:user_id/:user_function_id',
        component : SituationDatagrid,
        name      : 'situation-datagrid',

    },

    {

        path      : '/highlighter-datagrid/:user_id/:user_function_id',
        component : HighlighterDatagrid,
        name      : 'highlighter-datagrid',

    },

    {

        path      : '/user-function-datagrid/:user_id/:user_function_id',
        component : UserFunctionDatagrid,
        name      : 'user-function-datagrid',

    },

    {

        path      : '/adventure-datagrid/:user_id/:user_function_id',
        component : AdventureDatagrid,
        name      : 'adventure-datagrid',

    },

];

export default routes;