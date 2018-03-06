<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li>Menus</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">publish</th>
                            <th scope="col">created at</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in menus">
                            <td>{{ row.id }}</td>
                            <td>{{ row.title }}</td>
                            <td>{{ row.publish }}</td>
                            <td>{{ row.created_at }}</td>
                            <td>
                                <font-awesome-icon icon="sort-amount-up" @click="sortRow(row['id'])"/>
                                <font-awesome-icon icon="link" @click="links(row['id'])"/>
                                <font-awesome-icon icon="pencil-alt" @click="editRow(row['id'])"/>
                                <font-awesome-icon icon="times" @click="deleteRow(row)" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <paginate-helper :paginate="paginate" @clickLink="clickToLink($event)"></paginate-helper>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginateHelper from '../helper/PaginateHelper.vue';
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                menus: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getMenus();
        },
        methods: {
            getMenus(){
                axios.get('api/menus')
                    .then(res => {
                        this.menus = res.data.menus.data;
                        this.paginate = res.data.menus;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('menus/' + id + '/edit');
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
                        axios.delete('api/menus/' + row.id)
                            .then(res => {
                                this.menus = this.menus.filter(function (item) {
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
                })
            },
            clickToLink(index){
                axios.get('api/menus?page=' + index)
                    .then(res => {
                        this.menus = res.data.menus.data;
                        this.paginate = res.data.menus;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            links(id){
                this.$router.push('/menu-links/' + id + '/sort');
            },
            sortRow(id){
                this.$router.push('/menus/' + id + '/sort');
            }
        }
    }
</script>