<template>
<div>
  <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
    <b-card no-body>
        <b-card-header class="border-0">
            <h3 class="mb-0">Room</h3>
            <div class="float-right">
              <b-nav pills class="nav-pills-circle">
                <b-nav-item v-on:click="addRoomCard = !addRoomCard" active><i class="ni ni-fat-add"></i></b-nav-item>
              </b-nav>
            </div>
        </b-card-header>

        <el-table class="table-responsive table"
                  header-row-class-name="thead-light"
                  :data="rooms">
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
                             prop="room_category"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="property_autor"
                             prop="property_autor"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Edit"
                             min-width="170px"
                             prop="edit">
              <template v-slot="{row}">
                <base-button icon type="warning" @click="editRoom(row.id)">
                  <span class="btn-inner--icon"><i class="ni ni-scissors"></i></span>
                </base-button>
               
              </template>
            </el-table-column>
            <el-table-column label="Delete"
                             min-width="170px"
                             prop="delete">
              <template v-slot="{row}">    
                <base-button icon type="danger" @click="deleteRoom(row.id)">
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

  

      <form @submit.prevent="addRoom()" v-if="addRoomCard">
        <b-row class="form-group">
          <label for="example-search-input" class="col-md-2 col-form-label form-control-label">Name</label>
          <b-col md="10">
            <base-input type="text" id="example-search-input" placeholder="Alonso Diaz" v-model="room.name"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-email-input" class="col-md-2 col-form-label form-control-label">description</label>
          <b-col md="10">
            <base-input type="text"  placeholder="description" id="description" v-model="room.description"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">category_room</label>
          <b-col md="10">
            <base-input type="text" placeholder="category_room" id="category_room" v-model="room.category_room"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">valoration</label>
          <b-col md="10">
            <base-input type="text" placeholder="valoration" id="valoration" v-model="room.valoration"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">location</label>
          <b-col md="10">
            <base-input type="text" placeholder="location" id="location" v-model="room.location"></base-input>
          </b-col>
        </b-row>
        <b-row class="form-group">
          <label for="example-password-input"
                class="col-md-2 col-form-label form-control-label">location_description</label>
          <b-col md="10">
            <base-input type="text" placeholder="location_description" id="location_description" v-model="room.location_description"></base-input>
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
        addRoomCard: false,
        room: {
          name: '', 
          description: '',
          room_category: '',
          property_autor: ''
        },
        rooms: [
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
      this.getRooms()
    },
    methods: {
      getRooms(){
        let url = 'room/'+this.$route.params.id
        axios.get(url, this.config).then((result)=>{
            this.rooms = result.data.data.rooms;
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
              console.log(error);
          } else {
            console.log(error.response.data);
          } 
        });
      },
      addRoom(){
        if(this.room.name.trim() === '' || this.room.description.trim() === '' || this.room.room_category.trim() === '' || this.room.property_autor.trim() === ''){
          alert('Debes completar todos los campos antes de guardar');
          return;
        }
        let url = 'room'
        axios.post(url, this.room, this.config)
        .then((response) =>{
          this.getRoom()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      },
      editRoom(id){
        console.log(id)
      },
      deleteRoom(id){
        let url = 'room/'+id
        axios.delete(url, this.config)
        .then((response) =>{
          this.getRoom()
        }).catch((error) => {
          console.log(error.response.data);
        }) 
      }
    }
  }
</script>
