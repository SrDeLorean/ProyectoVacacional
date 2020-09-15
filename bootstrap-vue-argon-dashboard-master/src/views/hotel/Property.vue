<template>
<div>
  <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
    <b-card no-body>
        <b-card-header class="border-0">
            <h3 class="mb-0">Property</h3>
            <div class="float-right">
              <b-nav pills class="nav-pills-circle">
                <b-nav-item v-on:click="addPropertyCard = !addPropertyCard" active><i class="ni ni-fat-add"></i></b-nav-item>
              </b-nav>
            </div>
        </b-card-header>

        <el-table class="table-responsive table"
                  header-row-class-name="thead-light"
                  :data="properties">
            <el-table-column label="Id"
                        prop="id"
                        min-width="70px">
            </el-table-column>
            <el-table-column label="Name"
                             prop="name"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Description"
                             prop="description"
                             min-width="200px">
            </el-table-column>

            <el-table-column label="Category"
                             prop="category_property"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Valoration"
                             prop="valoration"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Location"
                             prop="location"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Location Description"
                             prop="location_description"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Edit"
                             min-width="170px"
                             prop="edit">
              <template v-slot="{row}">
                <base-button icon type="warning" @click="editProperty(row.id)">
                  <span class="btn-inner--icon"><i class="ni ni-scissors"></i></span>
                </base-button>
               
              </template>
            </el-table-column>
            <el-table-column label="Delete"
                             min-width="170px"
                             prop="delete">
              <template v-slot="{row}">    
                <base-button icon type="danger" @click="deleteProperty(row.id)">
                  <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                </base-button>
              </template>
            </el-table-column>

        </el-table>

        <b-card-footer class="py-4 d-flex justify-content-end">
            <base-pagination v-model="currentPage" :per-page="10" :total="50"></base-pagination>
        </b-card-footer>
    </b-card>
    </base-header>

  

      <form @submit.prevent="addProperty(property)" v-if="addPropertyCard">
        <b-row class="form-group">
          <label for="example-search-input" class="col-md-2 col-form-label form-control-label">Name</label>
          <b-col md="10">
            <base-input type="text" id="example-search-input" placeholder="Alonso Diaz" v-model="property.name"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-email-input" class="col-md-2 col-form-label form-control-label">description</label>
          <b-col md="10">
            <base-input type="text"  placeholder="description" id="description" v-model="property.description"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">category_property</label>
          <b-col md="10">
            <base-input type="text" placeholder="category_property" id="category_property" v-model="property.category_property"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">valoration</label>
          <b-col md="10">
            <base-input type="text" placeholder="valoration" id="valoration" v-model="property.valoration"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">location</label>
          <b-col md="10">
            <base-input type="text" placeholder="location" id="location" v-model="property.location"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">location_description</label>
          <b-col md="10">
            <base-input type="text" placeholder="location_description" id="location_description" v-model="property.location_description"></base-input>
          </b-col>
        </b-row>
        <button class="btn btn-primary" type="submit">Create</button>
      </form>

  </div>


</template>
<script>
  import { Table, TableColumn} from 'element-ui'
  import { mapGetters } from 'vuex'
  import axios from 'axios'
  export default {
    name: 'light-table',
    components: {
      [Table.name]: Table,
      [TableColumn.name]: TableColumn
    },
    data() {
      return {
        addPropertyCard: false,
        property: {
          name: '', 
          description: '',
          category_property: '',
          valoration: '',
          location: '',
          location_description: ''
        },
        properties: [
                ],
        currentPage: 1
      }
    },
    computed: {
        ...mapGetters({
            config: 'auth/config'
        })
    },
    created(){
      this.getProperties()
    },
    methods: {
      getProperties(){
        let url = 'property'
        axios.get(url, this.config).then((result)=>{
            this.properties = result.data.data.properties;
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
              console.log(error);
          } else {
            console.log(error.response.data);
          } 
        });
      },
      addProperty(){
        if(this.property.name.trim() === '' || this.property.description.trim() === '' || this.property.category_property.trim() === '' || this.property.location.trim() === '' || this.property.location_description.trim() === ''){
          alert('Debes completar todos los campos antes de guardar');
          return;
        }
        let url = 'property'
        axios.post(url, this.property, this.config)
        .then((response) =>{
          this.getProperty()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      },
      editProperty(id){
        console.log(id)
      },
      deleteProperty(id){
        let url = 'property/'+id
        axios.delete(url, this.config)
        .then((response) =>{
          this.getProperty()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      }
    }
  }
</script>
