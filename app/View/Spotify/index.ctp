<div id="app" class="row">
  <div class="col-md-12">
    <form @submit.prevent="search" class="form-horizontal">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-lg" placeholder="Busca por artista, album o canción... y disfruta" v-model="words">
          <div class="input-group-append">
          	<button class="btn" type="submit">
            	<i class="fas fa-search  fa-2x"></i>
          	</button>
          </div>
        </div>
    </form>

    <div class="alert alert-danger alert-dismissible" v-show="showErrorMessageBox">
	  <div class="row">
	  	<div class="col-md-3">
	  		<h5><i class="icon fas fa-ban"></i> Eh pue!</h5>
	  	</div>
	  	<div class="col-md-7">
	  		{{errorMessage}}
	  	</div>
	  </div>
	</div>

  </div>
  <div class="col-md-12" v-show="showInitialBox">
    <div class="card pt-5 pb-5">      
   		<div class="card-body">
	        <h1 class="text-center">
	        	<i class="fas fa-music"></i> 
	        	<i class="fas fa-drum"></i> 
	        	<i class="fas fa-guitar"></i>
	        	<i class="fas fa-microphone"></i>
	        	<br> 
	        	Busca tu música <br> favorita.
	        </h1>
      	</div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-4" v-show="!showInitialBox">
      <div class="card text-white bg-dark">
        <div class="card-header">
            <h3 class="card-title">Canciones</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body p-0" style="max-height: 400px;
      overflow-y: auto;">
            <table class="table">
            	<tbody>
                    <tr v-for="track in tracks.items">
                      <td><img :src="track.album.images[2].url"><br>
                      <td>{{track.name}} <br>
                    	<span class="small">por {{track.album.artists[0].name}}</span>
                      </td>
                      <td>
                      	<span v-show="showPauseIcon != track.id">
	                      	<i class="fas fa-play-circle"                      		
	                      		:id="track.id" 
	                      		:data-preview-url="track.preview_url"
	                      		v-on:click="playMusic(track.id)"
	                      	></i>
	                    </span>
	                    <span v-show="showPauseIcon === track.id">
	                      	<i class="fas fa-pause-circle" style="color:green"                   		
	                      		:id="track.id" 
	                      		:data-preview-url="track.preview_url"
	                      		v-on:click="stopMusic()"
	                      	></i>
	                    </span>
                      </td>
                    </tr>
                </tbody>
            </table>
          <!-- /.users-list -->
          </div>
          <div class="overlay" v-show="showLoading">
	    	<i class="fa fa-refresh fa-spin"></i>
	    </div>
      </div>
      <!--/.card -->
  </div>
  <div class="col-md-4" v-show="!showInitialBox">
      <!-- USERS LIST -->
      <div class="card text-white bg-dark">
        <div class="card-header">
            <h3 class="card-title">Artistas</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="users-list clearfix">
              <li v-for="artist in artists.items">
				<img class="img-fluid" v-if="artist.images[1] != null" :src="artist.images[1].url" width="64">
				<i v-else class="fab fa-spotify fa-4x"></i>
                  <a class="users-list-name" href="#">{{artist.name}}</a>
              </li>
            </ul>
          </div>
          <div class="overlay" v-show="showLoading">
	    	<i class="fa fa-refresh fa-spin"></i>
	      </div>
      </div>
      <!--/.card -->
  </div>

  <div class="col-md-4" v-show="!showInitialBox">
    <div class="card text-white bg-dark">
      <div class="card-header">
          <h3 class="card-title">Albums</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="row">
            	<div class="col-sm-3 col-3 mb-3" v-for="album in albums.items" >
	                <img class="img-fluid" :src="album.images[0].url" alt="Photo">
	                <a class="users-list-name" href="#">{{album.name}}</a>
	            </div>
        	</div>
        </div>
        <div class="overlay" v-show="showLoading">
	    	<i class="fa fa-refresh fa-spin"></i>
	    </div>      
    </div>
  </div>
</div>

<script type="text/javascript">
  var app = new Vue({
      el: '#app',
      data: {
        albums: {}
        ,tracks: {}
        ,artists: {}
        ,words: ''
        ,showLoading: false
        ,currentSong:''
        ,showPauseIcon: -1
        ,errorMessage: {}
        ,showErrorMessageBox: false
        ,showInitialBox: true
      },
      methods:{
        search(){
            console.log("Buscar...");
             this.showInitialBox = false;
            this.showErrorMessageBox = false;
            this.showLoading = true;
            axios.get('spotify/search/', {
            	params: {
                	words: encodeURI(this.words)
                }
            }).then((response) => {
            	if(typeof response.data.words !== 'undefined'){ 
	            	this.showErrorMessageBox = true;
	            	this.showLoading = false;
	            	this.errorMessage = response.data.words[0]; 
	         	}else{            	
	            	this.albums = response.data['albums'];
	            	this.tracks = response.data['tracks'];
	            	this.artists = response.data['artists'];
	            	this.showLoading = false;
	            	console.log("listando resultados.");
            	}
            });
        },
        playMusic(trackId){
        	if(this.currentSong instanceof Audio){
        		this.currentSong.pause();
        		this.showPauseIcon = -1
        	}

        	var track = document.getElementById(trackId);
        	this.currentSong = new Audio(track.dataset.previewUrl);
        	this.currentSong.play();
        	this.showPauseIcon = trackId;
        },
        stopMusic(){
        	this.currentSong.pause();
        	this.showPauseIcon = -1;
        }
      },
      created(){
      	this.showErrorMessageBox = false
     }
  })
</script>