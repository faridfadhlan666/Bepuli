
        <div class="row">
          <?php
          	echo "<br><b><center><h4>Artikel</h4></b></center>"; 
						include "adm-dc/koneksi.php";
						$data = mysqli_query($koneksi,"select * from artikel order by id_artikel asc limit 3");
						while($dt=mysqli_fetch_array($data)){
										
					?>

          <div class="col-lg-4 col-md-6 mb-4 mt-lg-0">
            <div class="box" data-aos="fade-left">
                <img src="adm-dc/artikel/<?=$dt['gambar'];?>" width="280px" height="200px">
                <br><br>
				        <p><b><?=substr($dt['judul'], 0, 90)?> </b></p>
                <p><?=substr($dt['deskripsi'], 0, 100)?> . . .</p>

              <div class="btn-wrap">
                <a href="detail-artikel.php?id_artikel=<?=$dt['id_artikel']?>" class="btn-buy">Selengkapnya</a>
              </div>
            </div>
          </div>
          	<?php }?>

        </div>

      