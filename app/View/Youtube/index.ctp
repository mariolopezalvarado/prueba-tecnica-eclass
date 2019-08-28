<div id="app" class="row">
  <div class="col-md-12">
    <form @submit.prevent="searchMusic" class="form-horizontal">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-lg" placeholder="Busca por artista, album o canción... y disfruta">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search fa-2x"></i></span>
          </div>
        </div>
    </form>
  </div>
  <div class="col-md-3">
      <div class="card text-white bg-dark">
        <div class="card-header">
            <h3 class="card-title">{{message}}</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body p-0" style="max-height: 400px;
      overflow-y: auto;">
            <table class="table">
                    <tbody>
                      <?php foreach ($data['tracks']['items'] as $track) { ?>
                        <tr>
                          <td><?php echo $track['name'] ?></td>
                          <td>
                            
                            <?php //echo $track['preview_url'] ?>"
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
          <!-- /.users-list -->
          </div>
          <!-- /.card-body -->
        <!-- /.card-footer -->
      </div>
      <!--/.card -->
  </div>

  <?php if($data['artists']['total'] > 0){ ?>
  <div class="col-md-4">
      <!-- USERS LIST -->
      <div class="card text-white bg-dark">
        <div class="card-header">
            <h3 class="card-title">Artistas</h3>
            <div class="card-tools">
              <span class="badge badge-success">
                Total: 
                <?php
                  echo count($data['artists']['items']);
                ?>
              </span>
            </div>
        </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="users-list clearfix">
              <?php foreach ($data['artists']['items'] as $artist) { ?>
              <li>
                  <?php 
                    if(isset($artist['images'][2]['url'])){
                      $image = '<img class="img-fluid" src="'.$artist['images'][1]['url'].'" width="64">';
                    }else{
                      $image = '<i class="fas fa-music fa-3x"></i>';
                    }

                    echo $image;
                  ?>
                  <a class="users-list-name" href="#"><?php echo $artist['name']; ?></a>
              </li>
              <?php } ?>
            </ul>
          <!-- /.users-list -->
          </div>
          <!-- /.card-body -->
        <!-- /.card-footer -->
      </div>
      <!--/.card -->
  </div>
<?php } ?>

  <div class="col-md-5">
    <!-- USERS LIST -->
    <div class="card text-white bg-dark">
      <div class="card-header">
          <h3 class="card-title">Albums</h3>
          <div class="card-tools">
              <span class="badge badge-success">
                 Total: 
                <?php
                  echo count($data['albums']['items']);
                ?> 
                </span>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="row m-3">
            <?php foreach ($data['albums']['items'] as $album) { ?>
            <div class="col-sm-3">
                <img class="img-fluid" src="<?php echo $album['images'][1]['url'] ?>" alt="Photo">
                <a class="users-list-name" href="#"><?php echo $album['name']." ".$album['artists'][0]['name'] ?></a>
              </div>
          <?php } ?>
        </div>
        <!-- /.users-list -->
        </div>
        <!-- /.card-body -->
      <div class="card-footer text-center">
        
      </div>
      <!-- /.card-footer -->
    </div>
    <!--/.card -->
  </div>
</div>

<script type="text/javascript">
  var app = new Vue({
      el: '#app',
      data: {
        message: 'Hello Vue!'
      },
      methods:{
        searchMusic(){
            console.log("Buscar...");
            axios.get('spotify/search_music').then((response) => {
                ///this.user = response.data
                console.log(response.data);
                
            });
            /*
            this.form.post('api/updateGeneralUserInfo')
            .then(()=>{
                toast.fire({
                  type: 'success',
                  title: 'Información actualizada correctamente'
                });
            })
            .catch(() => {
                toast.fire({
                  type: 'error',
                  title: 'Ocurrio un problema '
                });
            });
        */
        }
      },
      mounted(){
        console.log("listo");
        var that = this;
        axios.get('https://raw.githubusercontent.com/fernandoggaitan/vuejs_axios/master/response.json')
        .then(function (response) {
           that.helados = response.data;
        })
        .catch(function (error) {
           console.log('Error: ' + error);
        }); 
     }
  })
</script>