<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Dirección de Email:"
        label-for="input-1"
        description=""
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          type="email"
          required
          placeholder="Ingrese Email"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Nombre:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.name"
          required
          placeholder="Ingrese Nombre"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Categorias:" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.category"
          :options="categorys"
          required
        ></b-form-select>
      </b-form-group>

      <b-form-group id="input-group-4">
        <b-form-checkbox-group v-model="form.checked" id="checkboxes-4">
          <b-form-checkbox value="me">Check me out</b-form-checkbox>
          <b-form-checkbox value="that">Check that out</b-form-checkbox>
        </b-form-checkbox-group>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <!--<b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>-->
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          email: '',
          name: '',
          checked: [],
          category: []          
        },
        categorys: [],
        show: true
      }
    },
    props:['url'],
    created(){
          this.getCategorys();
        },
    methods: {
      getCategorys: function () {
          axios.get("categories").then(({ data }) => (this.categorys = data));
          console.log(this.categorys);
        },
      onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
        let me = this;
                axios.post(me.url+'/analysis/store',{
                    'id_analysis_category':me.categorySeleccionados.id_analysis_category,
                    'id_cash':me.id_cash,
                    'name_analysis':me.name_analysis,
                    'description':me.description,
                    'price':me.price
                }).then(function (response) {
                    me.cleanText();
                    me.listAnalysis();
                }).catch(function (error) {
                    console.log(error);
                    console.log(me.categorySeleccionados);
                });
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      
    }
  }
</script>