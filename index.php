<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUDS</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--link rel="stylesheet" href="css/all.min.css"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
  <div class="container-fluid">
    <h5 class="heading">PHP</h5>
    <div class="content">
      <button class="btn btn-dark m-3 insertts" data-bs-target="#modalinsert" data-bs-toggle="modal">insert data</button>
      <!--search-->
      <form action="search.php" method="post" class="search">
          <div class="row g-3 align-items-center float-end mb-3">
              <div class="col-auto">
                  <label for="inputsearch" class="col-form-label">Search:</label>
              </div>
              <div class="col-auto">
                  <input type="text" id="inputSearch" onkeyup="searchUser()" class="form-control" aria-describedby="SearchHelpInline" placeholder="search">
              </div>
          </div>
      </form>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>id</th>
            <th>user_name</th>
            <th>prenom</th>
            <th>nom</th>
            <th>tel</th>
            <th>mot_passe</th>
            <th>status</th>
            <th>gender</th>
            <th>country</th>
            <th>city</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      
    </div>
  </div>
  <!-- Modal insert-->
  <div class="modal fade" id="modalinsert" tabindex="-1" role="dialog" aria-labelledby="modalinsert" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">insert:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
              <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefaultin" name="status">
                  <label class="form-check-label" for="flexSwitchCheckDefault">active</label>
              </div>
              <div class="mb-3">
                  <label for="exampleusername" class="form-label">username:</label>
                  <input type="text" class="form-control" name="user_name" id="exampleusername" placeholder="username">
              </div>
              <div class="mb-3">
                  <label for="exampleprenom" class="form-label">prenom:</label>
                  <input type="text" class="form-control" name="prenom" id="exampleprenom" placeholder="prenom">
              </div>
              <div class="mb-3">
                  <label for="examplenom"  class="form-label">nom:</label>
                  <input type="text" class="form-control" name="nom" id="examplenom" placeholder="nom">
              </div>
              <div class="mb-3">
                  <label for="exampletel" class="form-label">tel:</label>
                  <input type="tel" class="form-control" name="tel" id="exampletel" placeholder="telephone">
              </div>
              <div class="mb-3">
                  <label for="examplepassword" class="form-label">mot_passe:</label>
                  <div class="password-div">
                  <input type="text" class="form-control" name="mot_passe" id="examplepassword" placeholder="mot de passe">
                  <button type="button" class="btn btn-outline-primary" id="reloadpassword" onclick="repassword()"><i class="fa-solid fa-arrows-rotate"></i></button>
                </div>
              </div>
              <div class="mb-3">
                  <label for="examplegender"  class="form-label">gender:</label>
                  <select class="form-select select1" aria-label="Default select example" name="gender_id" id="examplegender">                
                </select>
                <div id="response"></div>
              </div>            
              <div class="mb-3">
                  <label for=""  class="form-label">country:</label>
                  <div class="country-div">
                    <select class="form-select select2" aria-label="Default select example" name="country_id" id="examplecountry"></select>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalcountry"  >
                      <i class="fa-solid fa-plus"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalcountry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">add country</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="mb-3">
                                <label for="" class="form-label">country:</label>
                                <input type="text" class="form-control" name="country" id="examplecountry1" placeholder="country">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <div class="spa"></div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-outline-primary" id="addcountry">add country</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="mb-3">
                <label for="examplecity"  class="form-label">city:</label>
                <div class="city-div">
                  <select class="form-select select3" aria-label="Default select example" name="city_id" id="examplecity"></select>
                  <button type="button" class="btn btn-outline-primary" id="addcity" data-toggle="modal" data-target="#exampleModalcity">
                    <i class="fa-solid fa-plus"></i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalcity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">add city</h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="examplecity1" class="form-label">city:</label>
                            <input type="text" class="form-control" name="city" id="examplecity1" placeholder="city">
                          </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalcity" id="addcityin">add city</button>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>     
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary annuler" data-bs-dismiss="modal">Annuler</button>
            <button type="submit"class="btn btn-success" name="btn_insert" onclick="adduser()">insert</button>
        </div>
      </div>
    </div>   
    </div>
    <div class="modal fade" id="modalinsert2" aria-hidden="true" aria-labelledby="exampleModalmodalinsert2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bob">
          <h1 class="modal-title fs-5" id="exampleModalmodalinsert2">Modal 2</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bob">
        Donnees enregistrees avec succes
        </div>
        <div class="modal-footer">
          <button class="btn btn-success insertnew">insert new</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal delete-->
  <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modaldelete" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                are you sure what to delete this user?
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <form action="" method="post">
                    <input type="hidden" name="user_id" value="123" class="my_input">
                    <button type="button" name="btn_model_delete" id="confirmer" onclick="con()" class="btn btn-danger"
                    data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">confirmer</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Delete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Delete is succes.
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal update-->
  <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="modalupdate" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="table.php">
                  <div class="mb-3">
                      <input type="hidden" class="form-control" name="id" id="exampleidUp" disabled>
                  </div>
                  <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefaultUp" name="status">
                      <label class="form-check-label" for="flexSwitchCheckDefault" isChecked>active</label>
                  </div>
                  <div class="mb-3">
                      <label for="exampleusername" class="form-label">username</label>
                      <input type="text" class="form-control" name="user_name" id="exampleusernameUp" >
                  </div>
                  <div class="mb-3">
                      <label for="exampleprenom" class="form-label">prenom</label>
                      <input type="text" class="form-control" name="prenom" id="exampleprenomUp" >
                  </div>
                  <div class="mb-3">
                      <label for="examplenom"  class="form-label">nom</label>
                      <input type="text" class="form-control" name="nom" id="examplenomUp">
                  </div>
                  <div class="mb-3">
                      <label for="exampletel" class="form-label">tel</label>
                      <input type="tel" class="form-control" name="tel" id="exampletelUp">
                  </div>
                  <div class="mb-3">
                      <label for="examplepassword" class="form-label">mot_passe</label>
                      <div class="password-div">
                        <input type="text" class="form-control" name="mot_passe" id="examplepasswordUp">
                        <button type="button" class="btn btn-outline-primary" id="reloadpassword" onclick="repassword()"><i class="fa-solid fa-arrows-rotate"></i></button>
                      </div>
                  </div>
                  <div class="mb-3">
                    <label for="examplegender"  class="form-label">gender</label>
                    <select class="form-select " aria-label="Default select example" name="gender_id" id="examplegenderUp"></select>
                  </div>
                  <div class="mb-3">
                    <label for=""  class="form-label">country</label>
                    <select class="form-select select2" aria-label="Default select example" name="country_id" id="examplecountryUp"></select>
                  </div>
                  <div class="mb-3">
                    <label for="examplecity"  class="form-label">city</label>
                    <select class="form-select select3" aria-label="Default select example" name="city_id" id="examplecityUp"></select> 
                  </div>   
                </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" name="btn_model_update" id="confirmerupdate" onclick="updateUser()" class="btn btn-primary"
                  data-bs-target="#modalupdate2" data-bs-toggle="modal">confirmer</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="modalupdate2" aria-hidden="true" aria-labelledby="modalupdate2Label2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header upa">
          <h1 class="modal-title fs-5" id="modalupdate2Label2">UPDATE</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body upa">
          Donnees update avec succes.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary annuler" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </div>
  </div>
<script src="jq\jquery-3.6.3.min.js"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js/js.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>