<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createData">
                          Agregar usuario
                        </button>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Creación</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td v-text="item.id"></td>
                                <td v-text="item.name"></td>
                                <td v-text="item.email"></td>
                                <td v-text="item.created_at"></td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" @click.prevent="editUserData(item)">Editar</a>
                                        <a class="dropdown-item" href="#" @click.prevent="destroyUserData(item.id)">Eliminar</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal - Crear usuarios -->
        <div class="modal fade" id="createData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" @submit.prevent="createUserData()">
                    <div class="form-group">
                        <label for="Nombre">Nombre completo</label>
                        <input type="text" name="name" id="Nombre" :class="{'is-invalid':errorData.name}" class="form-control" placeholder="Nombre completo" v-model="formData.name">
                        <span class="text-danger" v-if="errorData.name" v-text="errorData.name[0]"></span>
                    </div>
                    <div class="form-group">
                        <label for="Email">Correo electrónico</label>
                        <input type="email" name="email" id="Email" :class="{'is-invalid':errorData.email}" class="form-control" placeholder="user@mail.co..." v-model="formData.email">
                        <span class="text-danger" v-if="errorData.email" v-text="errorData.email[0]"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" :class="{'is-invalid':errorData.password}" class="form-control" placeholder="123456" v-model="formData.password">
                        <span class="text-danger" v-if="errorData.password" v-text="errorData.password[0]"></span>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="formData.password_confirmation">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" @click.prevent="createUserData()">Registrar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal - Crear usuarios -->
        <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" @submit.prevent="updateUserData()">
                    <div class="form-group">
                        <label for="Nombre">Nombre completo</label>
                        <input type="text" name="name" id="Nombre" :class="{'is-invalid':errorData.name}" class="form-control" placeholder="Nombre completo" v-model="formfillData.name">
                        <span class="text-danger" v-if="errorData.name" v-text="errorData.name[0]"></span>
                    </div>
                    <div class="form-group">
                        <label for="Email">Correo electrónico</label>
                        <input type="email" name="email" id="Email" :class="{'is-invalid':errorData.email}" class="form-control" placeholder="user@mail.co..." v-model="formfillData.email">
                        <span class="text-danger" v-if="errorData.email" v-text="errorData.email[0]"></span>
                    </div><!-- 
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" :class="{'is-invalid':errorData.password}" class="form-control" placeholder="123456" v-model="formfillData.password">
                        <span class="text-danger" v-if="errorData.password" v-text="errorData.password[0]"></span>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="formfillData.password_confirmation">
                    </div> -->
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" @click.prevent="updateUserData()">Registrar</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                formData: {
                    'name': '',
                    'email': '',
                    'password': '',
                    'password_confirmation': ''
                },
                formfillData: {
                    'name': '',
                    'email': '',
                    'password': '',
                    'password_confirmation': ''
                },
                errorData: [],
            }
        },
        mounted() {
            this.getUsersData();
        },
        methods: {
            getUsersData: function(){
                axios.get('/api/users/').then(response => {
                    this.items = response.data;
                }).catch(error => {
                    console.log(error.response.data);
                });
            },
            createUserData: function () {
                axios.post('/api/users',this.formData).then(response => {
                    this.init();
                    $('#createData').modal('hide');
                    toastr.success(response.data);
                }).catch(error => {
                    this.errorData = error.response.data.errors;
                });
            },
            editUserData: function (item) {
                this.formfillData = item;
                $('#editData').modal('show');
            },
            updateUserData: function () {
                axios.put('/api/users/' + this.formfillData.id, this.formfillData).then(response => {
                    this.init();
                    $('#editData').modal('hide');
                    toastr.success(response.data);
                }).catch(error => {
                    this.errorData = error.response.data.errors;
                });
            },
            destroyUserData: function (id) {
                if (confirm('¿Seguro deseas eliminar a este usuario?')) {
                    axios.delete('/api/users/' + id).then(response => {
                        this.init();
                        toastr.succes(response.data);
                    }).catch(error => {
                        console.log(error.response.data.message);
                    });
                }
            },
            init: function(){
                this.getUsersData();
                this.formData = {
                    'name': '',
                    'email': '',
                    'password': '',
                    'password_confirmation': '',
                };
                this.errorData = [];
            },
        }
    }
</script>
