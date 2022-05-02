<?php
  include_once("vistas/plantilla.php");
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba</title>
</head>
<body>
    <form action="" id="formprueba">
        <input type="text" name="ci-in" id="ci-in" placeholder="INGRESE SU NOMBRE"><br>
        <button type="submit" id="enviar">ENVIAR</button>
        <br>    
        <input type="text" name="sesiones" id="sesiones" placeholder="sesiones">
        <input type="text" name="nombre" id="nombre" placeholder="nombre">
        <input type="text" name="apellido" id="apellido" placeholder="apellido">
        <input type="text" name="fecha_in" id="fecha_in" placeholder="fecha de inscripcion">
        <input type="text" name="fecha_fin" id="fecha_fin" placeholder="fecha de caducación">
        <br>
        <?php
            foreach($_SESSION['accesos_globales'] as $data)
            echo $data;         

        ?>
        <br>
        <?php
          echo $_SESSION['accesos_globales']['cliente_reporte_acceso'];
          echo $_SESSION['$rol']." esta es la varibale";
        ?>
    </form>
    <div class="container">
    <div class="row justify-content-center"> <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary py-2 px-4">Click Here !</button> <!-- Modal-->
        <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                        <div class="tabs" id="tab01">
                            <h6 class="text-muted">My Apps</h6>
                        </div>
                        <div class="tabs active" id="tab02">
                            <h6 class="font-weight-bold">Knowledge Center</h6>
                        </div>
                        <div class="tabs" id="tab03">
                            <h6 class="text-muted">Communities</h6>
                        </div>
                        <div class="tabs" id="tab04">
                            <h6 class="text-muted">Education</h6>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="modal-body p-0">
                        <fieldset id="tab011">
                            <div class="bg-light">
                                <h5 class="text-center mb-4 mt-0 pt-4">My Apps</h5>
                                <h6 class="px-3">Most Used Apps</h6>
                                <ol class="pb-4">
                                    <li>Watsapp</li>
                                    <li>Instagram</li>
                                    <li>Chrome</li>
                                    <li>Linkedin</li>
                                </ol>
                            </div>
                            <div class="px-3">
                                <h6 class="pt-3 pb-3 mb-4 border-bottom"><span class="fa fa-android"></span> Suggested Apps</h6>
                                <h6 class="text-primary pb-2"><a href="#">Opera Browser</a> <span class="text-secondary">- One of the best browsers</span></h6>
                                <h6 class="text-primary pb-2"><a href="#">Camscanner</a> <span class="text-secondary">- Easily scan your documents</span></h6>
                                <h6 class="text-primary pb-4"><a href="#">Coursera</a> <span class="text-secondary">- Learn online, lecturers from top universities</span></h6>
                            </div>
                        </fieldset>
                        <fieldset class="show" id="tab021">
                            <div class="bg-light">
                                <h5 class="text-center mb-4 mt-0 pt-4">Knowledge Center</h5>
                                <form>
                                    <div class="form-group pb-5 px-3"> <select name="account" class="form-control">
                                            <option selected disabled>Select Product</option>
                                            <option>Product 1</option>
                                            <option>Product 2</option>
                                            <option>Product 3</option>
                                            <option>Product 4</option>
                                        </select> </div>
                                </form>
                            </div>
                            <div class="px-3">
                                <h6 class="pt-3 pb-3 mb-4 border-bottom"><span class="fa fa-star"></span> Popular Topics</h6>
                                <h6 class="text-primary pb-2"><a href="#">Getting started with Blazemeter</a></h6>
                                <h6 class="text-primary pb-2"><a href="#">Creating tests</a></h6>
                                <h6 class="text-primary pb-4"><a href="#">Running tests</a></h6>
                            </div>
                        </fieldset>
                        <fieldset id="tab031">
                            <div class="bg-light">
                                <h5 class="text-center mb-4 mt-0 pt-4">Communities</h5>
                                <form>
                                    <div class="form-group pb-5 px-3 row justify-content-center"> <button type="button" class="btn btn-primary">New Community +</button> </div>
                                </form>
                            </div>
                            <div class="px-3">
                                <div class="border border-1 box">
                                    <h5>Community 1</h5>
                                    <p class="text-muted mb-1">Members : <strong>27</strong></p>
                                </div>
                                <div class="border border-1 box">
                                    <h5>Community 2</h5>
                                    <p class="text-muted mb-1">Members : <strong>16</strong></p>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="tab041">
                            <div class="bg-light">
                                <h5 class="text-center mb-4 mt-0 pt-4">Education</h5>
                                <form>
                                    <div class="form-group pb-2 px-3"> <input type="text" placeholder="Enter College Name" class="form-control"> </div>
                                    <div class="form-group row pb-2 px-3">
                                        <div class="col-6"> <input type="text" placeholder="Percentage" class="form-control"> </div>
                                        <div class="col-6"> <input type="text" placeholder="Grade" class="form-control"> </div>
                                    </div>
                                    <div class="form-group px-3 pb-2"> <label class="form-control-label">
                                            <h6>What are you good at ?</h6>
                                        </label>
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" id="option1" type="checkbox" value=""> <label class="custom-control-label" for="option1">Web Development</label> </div>
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" id="option2" type="checkbox" value=""> <label class="custom-control-label" for="option2">Data Structures & Algorithms</label> </div>
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" id="option3" type="checkbox" value=""> <label class="custom-control-label" for="option3">Android Development</label> </div>
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" id="option4" type="checkbox" value=""> <label class="custom-control-label" for="option4">Blockchain</label> </div>
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" id="option5" type="checkbox" value=""> <label class="custom-control-label" for="option5">Machine Learning Algorithms</label> </div>
                                    </div>
                                    <div class="form-group pb-5 row justify-content-center"> <button type="button" class="btn btn-primary px-3">Submit</button> </div>
                                </form>
                            </div>
                            <div class="px-3">
                                <h6 class="pt-3 pb-3 mb-4 border-bottom"><span class="fa fa-rocket"></span> Trending Technologies</h6>
                                <h6 class="text-primary pb-2"><a href="#">Augmented Reality and Virtual Reality</a></h6>
                                <h6 class="text-primary pb-2"><a href="#">Angular and React</a></h6>
                                <h6 class="text-primary pb-2"><a href="#">Big Data and Hadoop</a></h6>
                                <h6 class="text-primary pb-4"><a href="#">Internet of Things (IoT)</a></h6>
                            </div>
                        </fieldset>
                    </div>
                    <div class="line"></div>
                    <div class="modal-footer d-flex flex-column justify-content-center border-0">
                        <p class="text-muted">Can't find what you're looking for?</p> <button type="button" class="btn btn-primary">Contact Support Team</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container loginContainer">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 col-xs-6 col-md-4 col-md-offset-2 loggingModal loggings" ng-click="showSignup=false; " ng-class="{'activeLogging':!showSignup}">
      Login
    </div>
    <div class="col-sm-4  col-xs-6 col-md-4  loggingModal loggings" ng-click="showSignup=true;" ng-class="{'activeLogging':showSignup}">
      Sign Up
    </div>
  </div>
  <login ng-show="!showSignup;"></login>
  <signup ng-show="showSignup;"></signup>
</div>
<button
  type="button"
  mdbBtn
  color="default"
  rounded="true"
  data-toggle="modal"
  data-target="#basicExample"
  (click)="frame.show()"
  mdbWavesEffect
>
  Launch Modal
</button>

<div
  mdbModal
  #frame="mdbModal"
  class="modal fade top"
  id="frameModalTop"
  tabindex="-1"
  role="dialog"
  aria-labelledby="myModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">
        <!-- Tab panels -->
        <mdb-tabset
          #staticTabs
          [buttonClass]="'nav md-tabs tabs-2 light-blue darken-3'"
          [contentClass]="''"
          class="tab-content"
        >
          <!--Panel 7-->
          <mdb-tab
            class="tab-pane fade in show active"
            id="panel7"
            role="tabpanel"
            heading="<i class='fas fa-user'></i> Login"
          >
            <!--Body-->
            <div class="modal-body mb-1">
              <form [formGroup]="validatingForm">
                <div class="md-form form-sm">
                  <mdb-icon fas icon="envelope" class="prefix"></mdb-icon>
                  <input
                    mdbInput
                    mdbValidate
                    type="text"
                    id="form22"
                    class="form-control"
                    formControlName="modalFormLoginEmail"
                  />
                  <label for="form22">Your email</label>
                  <mdb-error
                    *ngIf="
                      modalFormLoginEmail.invalid &&
                      (modalFormLoginEmail.dirty || modalFormLoginEmail.touched)
                    "
                  >
                    Input invalid
                  </mdb-error>
                  <mdb-success
                    *ngIf="
                      modalFormLoginEmail.valid &&
                      (modalFormLoginEmail.dirty || modalFormLoginEmail.touched)
                    "
                    >Input valid
                  </mdb-success>
                </div>

                <div class="md-form form-sm">
                  <mdb-icon fas icon="lock" class="prefix"></mdb-icon>
                  <input
                    mdbInput
                    mdbValidate
                    type="password"
                    id="form23"
                    class="form-control"
                    formControlName="modalFormLoginPassword"
                  />
                  <label for="form23">Your password</label>
                  <mdb-error
                    *ngIf="
                      modalFormLoginPassword.invalid &&
                      (modalFormLoginPassword.dirty || modalFormLoginPassword.touched)
                    "
                  >
                    Input invalid
                  </mdb-error>
                  <mdb-success
                    *ngIf="
                      modalFormLoginPassword.valid &&
                      (modalFormLoginPassword.dirty || modalFormLoginPassword.touched)
                    "
                  >
                    Input valid
                  </mdb-success>
                </div>
              </form>
              <div class="text-center mt-2">
                <button mdbBtn color="info" class="waves-light" mdbWavesEffect>
                  Log in
                  <mdb-icon fas icon="sign-in-alt" class="ml-1"></mdb-icon>
                </button>
              </div>
            </div>
            <!--Footer-->
            <div class="modal-footer display-footer">
              <div class="options text-center text-md-right mt-1">
                <p>
                  Not a member?
                  <a href="#" class="blue-text">Sign Up</a>
                </p>
                <p>
                  Forgot
                  <a href="#" class="blue-text">Password?</a>
                </p>
              </div>
              <button
                type="button"
                mdbBtn
                color="info"
                outline="true"
                class="ml-auto"
                data-dismiss="modal"
                (click)="frame.hide()"
                mdbWavesEffect
              >
                Close
              </button>
            </div>
          </mdb-tab>
          <!--/.Panel 7-->

          <!--Panel 8-->
          <mdb-tab
            class="tab-pane fade"
            id="panel8"
            role="tabpanel"
            heading="<i class='fas fa-user-plus'></i> Register"
          >
            <!--Body-->
            <div class="modal-body">
              <form [formGroup]="validatingForm">
                <div class="md-form form-sm">
                  <mdb-icon fas icon="envelope" class="prefix"></mdb-icon>
                  <input
                    mdbInput
                    mdbValidate
                    type="text"
                    id="form24"
                    class="form-control"
                    formControlName="modalFormRegisterEmail"
                  />
                  <label for="form24">Your email</label>
                  <mdb-error
                    *ngIf="
                      modalFormRegisterEmail.invalid &&
                      (modalFormRegisterEmail.dirty || modalFormRegisterEmail.touched)
                    "
                  >
                    Input invalid
                  </mdb-error>
                  <mdb-success
                    *ngIf="
                      modalFormRegisterEmail.valid &&
                      (modalFormRegisterEmail.dirty || modalFormRegisterEmail.touched)
                    "
                  >
                    Input valid
                  </mdb-success>
                </div>

                <div class="md-form form-sm">
                  <mdb-icon fas icon="lock" class="prefix"></mdb-icon>
                  <input
                    mdbInput
                    mdbValidate
                    type="password"
                    id="form25"
                    class="form-control"
                    formControlName="modalFormRegisterPassword"
                  />
                  <label for="form25">Your password</label>
                  <mdb-error
                    *ngIf="
                      modalFormRegisterPassword.invalid &&
                      (modalFormRegisterPassword.dirty || modalFormRegisterPassword.touched)
                    "
                  >
                    Input invalid
                  </mdb-error>
                  <mdb-success
                    *ngIf="
                      modalFormRegisterPassword.valid &&
                      (modalFormRegisterPassword.dirty || modalFormRegisterPassword.touched)
                    "
                  >
                    Input valid
                  </mdb-success>
                </div>

                <div class="md-form form-sm">
                  <mdb-icon fas icon="lock" class="prefix"></mdb-icon>
                  <input
                    mdbInput
                    mdbValidate
                    type="password"
                    id="form26"
                    class="form-control"
                    formControlName="modalFormRegisterRepeatPassword"
                  />
                  <label for="form26">Repeat password</label>
                  <mdb-error
                    *ngIf="
                      modalFormRegisterRepeatPassword.invalid &&
                      (modalFormRegisterRepeatPassword.dirty ||
                        modalFormRegisterRepeatPassword.touched)
                    "
                  >
                    Input invalid
                  </mdb-error>
                  <mdb-success
                    *ngIf="
                      modalFormRegisterRepeatPassword.valid &&
                      (modalFormRegisterRepeatPassword.dirty ||
                        modalFormRegisterRepeatPassword.touched)
                    "
                  >
                    Input valid
                  </mdb-success>
                </div>

                <div class="text-center form-sm mt-2">
                  <button mdbBtn color="info" class="waves-light" mdbWavesEffect>
                    Sign up
                    <mdb-icon fas icon="sign-in-alt" class="ml-1"></mdb-icon>
                  </button>
                </div>
              </form>
            </div>
            <!--Footer-->
            <div class="modal-footer">
              <div class="options text-right">
                <p class="pt-1">
                  Already have an account?
                  <a href="#" class="blue-text">Log In</a>
                </p>
              </div>
              <button
                type="button"
                mdbBtn
                color="info"
                outline="true"
                class="ml-auto"
                data-dismiss="modal"
                (click)="frame.hide()"
                mdbWavesEffect
              >
                Close
              </button>
            </div>
          </mdb-tab>
          <!--/.Panel 8-->
        </mdb-tabset>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

    <div class="alert alert-success" role="alert" id="estado"></div>
  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>

  <script type="text/javascript" src="js/asistencia.js"></script>

</body>
</html>



1,1,1,1,1,1,1,1,1,0,0,1,1,0,0,0
5 no inscritos