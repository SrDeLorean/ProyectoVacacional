<template>
<base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
    <b-card no-body>
        <b-card-header class="border-0">
            <h3 class="mb-0">Light table</h3>
        </b-card-header>

        <el-table class="table-responsive table"
                  header-row-class-name="thead-light"
                  :data="users">
            <el-table-column label="Name"
                             min-width="200px"
                             prop="name">
                <template v-slot="{row}">
                    <b-media no-body class="align-items-center">
                        <b-media-body>
                            <span class="font-weight-600 name mb-0 text-sm">{{row.id}}</span>
                        </b-media-body>
                        <b-media-body>
                            <span class="font-weight-600 name mb-0 text-sm">{{row.name}}</span>
                        </b-media-body>
                    </b-media>
                </template>
            </el-table-column>
            <el-table-column label="Email"
                             prop="email"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Role"
                             min-width="170px"
                             prop="role">
                <template v-slot="{row}">
                    <badge class="badge-dot mr-4" type="">
                        <i :class="`bg-${row.enail}`"></i>
                        <span class="status" :class="`text-${row.enail}`">{{row.role}}</span>
                    </badge>
                </template>
            </el-table-column>

        </el-table>

        <b-card-footer class="py-4 d-flex justify-content-end">
            <base-pagination v-model="currentPage" :per-page="10" :total="50"></base-pagination>
        </b-card-footer>
    </b-card>
    </base-header>
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
            console.log(result.data)
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
              console.log(error);
          } else {
            console.log(error.response.data);
          } 
        });
      }
    },
  }
</script>
