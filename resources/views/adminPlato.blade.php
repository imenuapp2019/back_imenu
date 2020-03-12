@extends('layouts.app')

@section('content')
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pruebamodal">Panel de platos</button>

<div class="modal fade" id="pruebamodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class = "modal-header">

        <div class = "container" style ="margin-top: 60px">

            <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#plato" data-toggle = "tab">Plato</a>

            </li>
             <li class="nav-item">
              <a class="nav-link" href="#galeria" data-toggle = "tab">Menús asignados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#alergenos" data-toggle = "tab">Alergenos</a>
            </li>
          </ul>

          <div class = "tab-content">
            <div id="plato" class="container tab-pane active"><br>
                <h3>Plato</h3>

                <form>
                    <div class="form-group">
                        <label for="plato">Nombre del plato:</label>
                        <input type="text" class="form-control" id="name">
                      </div>

                      <div class="form-group">
                        <label for="plato">Descripción del plato:</label>
                        <textarea class="form-control" name="message" rows="10"></textarea>
                      </div>

                      <div class = "form-group">
                        <li> <label for="quantity">Precio (Entre 1 y 700€):</label>
                         <input type="number"  id="quantity" name="quantity" min="1" max="700" > € </li>

                     </div>


                     <form class="md-form">
                      <div class="file-field">
                        <div class="z-depth-1-half mb-4">
                          <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid"
                            alt="example placeholder">
                        </div>
                        <div class="d-flex justify-content-center">
                          <div class="btn btn-mdb-color btn-rounded float-left">

                            <input type="file">
                          </div>
                        </div>
                      </div>
                    </form>

                    <button type="submit" class="btn btn-primary">Guardar plato</button>
                </form>



              </div>
              <div id="galeria" class="container tab-pane fade"><br>
                <h3>Menús asignados</h3>

                <p>
                  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Asignar Menús
                  </a>

                </p>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <ul class="list-group">
                      <li class="list-group-item">Menú de algo</li>
                      <li class="list-group-item">Menú de otra cosa</li>
                      <li class="list-group-item">Otro Menú</li>
                      <li class="list-group-item">Menú de no se que</li>
                      <li class="list-group-item">Menú Lorenzo</li>
                    </ul>
                  </div>
                </div>



              <div style = "margin-top: 60px">

                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Menú 1 <button class="btn btn-primary" type="submit"> - </button> </li>
                  <li class="list-group-item">Menú 2 <button class="btn btn-primary" type="submit"> - </button></li>
                  <li class="list-group-item">Menú 3 <button class="btn btn-primary" type="submit"> - </button></li>
                  <li class="list-group-item">Menú 4 <button class="btn btn-primary" type="submit"> - </button></li>
                  <li class="list-group-item">Menú 5 <button class="btn btn-primary" type="submit"> - </button></li>
                </ul>

              </div>

                <div class = "button">
                <button type="submit" class="btn btn-primary">Guardar Menú</button> </div>



              </div>
              <div id="alergenos" class="container tab-pane fade"><br>
                <h3>Alergenos</h3>

                <div class="row">
                    <div class="col-md-12">

                      <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          Alergenos
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                          <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here..">
                            <option value="" disabled selected>Elige los alergenos</option>
                            <option value="1">Pescado</option>
                            <option value="2">Harina</option>
                            <option value="3">Lacteos</option>
                            <option value="4">Huevo</option>
                            <option value="5">Frutos secos</option>
                          </select>
                        </div>
                      </div>



                      <button class="btn-save btn btn-primary btn-sm" style="margin-left: 60px">Guardar</button>

                    </div>
                  </div>


              </div>


            </div>
          </div>
  </div>
</div>
  </div>
</div>

@endsection
