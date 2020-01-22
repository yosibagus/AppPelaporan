<div class="card" style="border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,.5);">
	<div class="card-header">
		<b>Grafik Laporan Masuk</b>
	</div>
	<div class="card-body">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	    <?php

		$connect = mysqli_connect("localhost", "root", "", "pelaporan");

		$query = "SELECT *, count(tb_laporan.kd_kat) as jml_kat FROM tb_laporan left join tb_kategori on tb_kategori.kd_kat=tb_laporan.kd_kat group by tb_laporan.kd_kat";

		$result = mysqli_query($connect, $query);

		 

		$data = '';

		while($row = mysqli_fetch_array($result)){
		  $data .= "{jumlah:".$row["jml_kat"].",kategori:'".$row["nm_kat"]."'}, 
		  ";
		}
		?>
		<div id="graph"></div>
	    <script>
	        Morris.Bar({
	          element: 'graph',
	          data: [<?php echo $data;?>],
	          xkey: 'kategori',
	          ykeys: ['jumlah'],
	          labels: ['Jumlah']
	        });
	    </script>
	</div>
</div>



			</div>
          </div>
        </div>
      </section>
    </main>