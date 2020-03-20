<template>
  <div class="container">
    <div class="row">
       <div class="col-md-6">
        <multiselect
          v-model="categorySeleccionados"
          :options="categorys"
          :multiple="true"
          :taggable="true"
          track-by="id_analysis_category"
          label="Categorias"
          placeholder="Seleccionar Categorias">
        </multiselect>
        <div>
          <button @click="addCategory">Agregar a la BD</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect';

  export default {
    components: { 
        Multiselect 
    },
    data () {
      return {
        categorySeleccionados: null,
        categorys: [],
      }
    },
    created() {
        this.getCategory();
    },
    methods: {
        getCategory: function () {
          axios.get("categories").then(({ data }) => (this.categorys = data));
        },
        storeCategory(){
                let me = this;
                axios.post('/salvar',{
                    'libro_id': this.libro_id,
                    'autor_id': this.autor_id,
                    'data':this.librosSeleccionados
                })
                .then(function (response) {
                window.alert('Libros agregados a la BD!')
                }).catch(function (error) {
                    window.alert('Ocurrió un error.')
                });
            },
        addLibros() {
           axios.post('/salvar', {'data':this.librosSeleccionados})
            .then(function (response) {
                window.alert('Libros agregados a la BD!')
            }).catch(function (error) {
                window.alert(error)
            });
        }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>