<template>
<div>
  <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
    <b-card no-body>
        <b-card-header class="border-0">
            <h3 class="mb-0">Users</h3>
            <div class="float-right">
              <b-nav pills class="nav-pills-circle">
                <b-nav-item v-on:click="addUserCard = !addUserCard" active><i class="ni ni-fat-add"></i></b-nav-item>
              </b-nav>
            </div>
        </b-card-header>

        <el-table class="table-responsive table"
                  header-row-class-name="thead-light"
                  :data="users">
            <el-table-column label="Id"
                        prop="id"
                        min-width="70px">
            </el-table-column>
            <el-table-column label="Name"
                             prop="name"
                             min-width="140px">
            </el-table-column>
            <el-table-column label="Email"
                             prop="email"
                             min-width="200px">
            </el-table-column>

            <el-table-column label="Role"
                             prop="role"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Edit"
                             min-width="170px"
                             prop="edit">
              <template v-slot="{row}">
                <base-button icon type="warning" @click="editUser(row.id)">
                  <span class="btn-inner--icon"><i class="ni ni-scissors"></i></span>
                </base-button>
               
              </template>
            </el-table-column>
            <el-table-column label="Delete"
                             min-width="170px"
                             prop="delete">
              <template v-slot="{row}">    
                <base-button icon type="danger" @click="deleteUser(row.id)">
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

  

      <form @submit.prevent="addUser(user)" v-if="addUserCard">
        <b-row class="form-group">
          <label for="example-search-input" class="col-md-2 col-form-label form-control-label">Name</label>
          <b-col md="10">
            <base-input type="text" id="example-search-input" placeholder="Alonso Diaz" v-model="user.name"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-email-input" class="col-md-2 col-form-label form-control-label">Email</label>
          <b-col md="10">
            <base-input type="email" autocomplete="username email" placeholder="example@gmail.com" id="example-email-input" v-model="user.email"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">Role</label>
          <b-col md="10">
            <base-input type="text" autocomplete="current-password" placeholder="role" id="example-password-input" v-model="user.role"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">Password</label>
          <b-col md="10">
            <base-input type="password" autocomplete="current-password" placeholder="password" id="example-password-input" v-model="user.password"></base-input>
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
        addUserCard: false,
        user: {
          name: '', 
          email: '',
          role: '',
          password: ''
        },
        users: [
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
      this.getUser()
    },
    methods: {
      getUser(){
        let url = 'usuario'
        axios.get(url, this.config).then((result)=>{
            this.users = result.data.data.users;
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
              console.log(error);
          } else {
            console.log(error.response.data);
          } 
        });
      },
      addUser(){
        if(this.user.name.trim() === '' || this.user.email.trim() === '' || this.user.role.trim() === '' || this.user.password.trim() === ''){
          alert('Debes completar todos los campos antes de guardar');
          return;
        }
        let url = 'usuario'
        axios.post(url, this.user, this.config)
        .then((response) =>{
          this.getUser()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      },
      editUser(id){
        console.log(id)
      },
      deleteUser(id){
        let url = 'usuario/'+id
        axios.delete(url, this.config)
        .then((response) =>{
          this.getUser()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      }

    },
    
  }
</script>
