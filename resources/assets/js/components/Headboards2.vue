<template>
  <b-container>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Ordenar"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="sm" :disabled="!sortBy" class="w-25">
              <option :value="false">Desc</option>
              <option :value="true">Asc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
        <b-form-group
          label="Per page"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          label-for="perPageSelect"
          class="mb-0"
        >
          <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="sm"
            :options="pageOptions"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col sm="7" md="6" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      small
      stacked="md"
      :items="arrayHeadboards"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="cargarPDF(row.item.id_headboards)" class="mr-1">
          PDF
        </b-button>
      </template>

      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
  </b-container>
</template>

<script>
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
  export default {
    data() {
      return {
            id_analysis_category:0,
            arrayHeadboards: [],
            tipoAccion : 0,
            errorPersona : 0,
            errorMostrarMsjPersona : [],
        fields: [
          { key: 'referencia_name', label: 'Código', sortable: true, class: 'text-center', sortDirection: 'desc' },
          { key: 'display_name', label: 'Código Referencia', sortable: true, class: 'text-center' },
          { key: 'id_headboards', label: 'Código Paciente', sortable: true, class: 'text-center' },
          { key: 'total', label: 'Total', sortable: true, class: 'text-center' },
          { key: 'created_at', label: 'Fecha Creación', sortable: true, class: 'text-center' },
          { key: 'actions', label: 'Actions',class: 'text-left' }
        ],
        totalRows: 1,
        currentPage: 1,
        perPage: 2,
        pageOptions: [2, 4, 6],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'desc',
        filter: null,
        filterOn: [],
        infoModal: {
          id: 'info-modal',
          title: '',
          content: ''
        }
      }
    },
    props:['url'],
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.arrayHeadboards.length;
      this.listHeadboards();
    },
    created(){
      this.getCategorys();
    },
    methods: {
      info(item, index, button) {
        this.infoModal.title = `Row index: ${index}`
        this.infoModal.content = JSON.stringify(item, null, 2)
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.content = ''
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      getCategorys: function () {
          axios.get("categories").then(({ data }) => (this.categorys = data));
        },
      listHeadboards(){
                let me=this;
                axios.get(this.url+'/headboards/index').then(function (response) {
                    me.arrayHeadboards = response.data;
                    me.totalRows = me.arrayHeadboards.length;
                    console.log(me.arrayHeadboards);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPDF(id_headboards){
              let me = this;
              console.log(me.id_headboards);
          window.open(me.url+'/ficha/cargarPdfHeadboards?id_headboards='+id_headboards, '_blank');          
          }
    }
  }
</script>