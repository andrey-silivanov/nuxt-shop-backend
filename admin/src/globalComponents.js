import DropDown from './components/Dropdown.vue'
import AutoComplete from '@/components/Autocomplete/Autocomplete';
import Paginate from 'vuejs-paginate';
import OrderTable from '@/components'


/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install (Vue) {
    Vue.component('drop-down', DropDown);
    Vue.component('autocomplete', AutoComplete);
    Vue.component('paginate', Paginate);
    Vue.component('ordered-table', OrderTable);
  }
};

export default GlobalComponents
