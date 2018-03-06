<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Menus</router-link></li>
                            <li><router-link tag="a" :to="'/menus/' + this.$route.params.id + '/edit'">{{ menuName }}</router-link></li>
                            <li>Menu links</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Menu links</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">title</th>
                                <th scope="col">publish</th>
                                <th scope="col">lang</th>
                                <th scope="col">created at</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in menuLinks">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.publish }}</td>
                                <td>{{ row.translations.length }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <font-awesome-icon icon="pencil-alt" @click="editRow(row['id'])"/>
                                    <font-awesome-icon icon="times" @click="deleteRow(row)" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import draggable from 'vuedraggable';

    export default {
        data(){
          return {
              menuLinks: {},
              menu: {},
              links: [],
              links2: [],
              lastId: 1,
              error: null,
          }
        },
        computed: {
            menuName(){
                return this.menu.title;
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'draggable': draggable
        },
        created(){
            this.getMenuList();
        },
        methods: {
            submit(){
                axios.post('api/menu-links/' + this.menu.id + '/order', {links: this.links})
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.menu = res.data.menu;
                        this.links = res.data.links;
                        this.lastId = res.data.lastId;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getMenuList(){
                axios.get('api/menu-links?id=' + this.$route.params.id)
                    .then(res => {
                        console.log(res.data);
                        this.menu = res.data.menu;
                        this.menuLinks = res.data.menuLinks;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            addRow(){
                this.$router.push('/menu-links/' + this.$route.params.id + '/create');
            },
            editRow(id){
                this.$router.push('/menu-links/' + id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/menu-links/' + row.id)
                            .then(res => {
                                this.menuLinks = this.menuLinks.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                });
            },
            update(){
                this.links.map((link, index) => {
                    link.order = index + 1;
                });
            },
        }
    }
</script>