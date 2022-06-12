<table align="center" style="width: 700px;">
	<tr>
		<td style="text-align: center;">
			<img width="18%" src="<?= './assets/kop/ubj.png' ?>">
		</td>
		<td style="width: 82%; font-family: Verdana; font-size: x-small; text-align: center;">

			<b style="font-size: 20px">UNIVERSITAS BHAYANGKARA JAKARTA RAYA</b>
			<br><b style="font-size: 16px">Jl. Darmawangsa I No. 1 Kebayoran Baru , Jakarta 12140</b>
			<br><b style="font-size: 16px">Telepon : (021) 7267655, 7267657, 7231948, Fax : (021) 7267657</b>
			<br><b style="font-size: 16px">Jl. Perjuangan, Bekasi Utara</b>
			<br><b style="font-size: 16px">Telepon : (021) 88955882, Fax : (021) 88955871</b>
		</td>
	</tr>

</table>
<table align="center" style="width: 100%;">
	<tr>
		<td colspan="2" style="border: 0px solid #000; border-width: 1px 0 1px 0; padding: 1px">
		</td>
	</tr>
</table>

<br>
<br>
<table align="center" style="width: 100%;">
	<tr>
		<td style="text-align: center;">
			<b style="font-size: 20px">LAPORAN PENGUJI SIDANG PROPOSAL SKRIPSI
				<?php
				if (isset($tahun_akademik)) {
					foreach ($g_thn_akdmk as $data) :
						$tahun_akademik_id = $data['tahun_akademik_id'];
						$tahun             = $data['tahun'];
						$semester          = $data['semester'];

						if ($tahun_akademik == $tahun_akademik_id) {
							echo $tahun;
							echo  $semester == 1 ? " (GANJIL)" : " (GENAP)";
						}
					endforeach;
				} else {
					echo "";
				}
				?>
			</b>
		</td>
	</tr>
</table>
<br>
<br>

<style>
	table.minimalistBlack {
		background-color: #FFFFFF;
		width: 100%;
		text-align: left;
		border-collapse: collapse;
	}

	table.minimalistBlack td,
	table.minimalistBlack th {
		border: 1px solid #000000;
	}

	table.minimalistBlack thead {
		background: #CFCFCF;
		background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
		background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
		background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
	}

	table.minimalistBlack thead th {
		/* font-size: 15px; */
		font-weight: bold;
		color: #000000;
		text-align: center;
	}
</style>

<table class="minimalistBlack" style="width:100%;">
	<thead>
		<tr>
			<th style="width:1%;">No</th>
			<th>NPM</th>
			<th>Nama Lengkap</th>
			<th>Judul Proposal</th>
			<th>Dosen Penguji I</th>
			<th>Dosen Penguji II</th>
			<th>Tanggal Sidang</th>
			<th>Waktu</th>
			<th>Ruangan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (!empty($g_jdw_ppsal)) {
			$no = 1;
			foreach ($g_jdw_ppsal as $data) :
				$sdg_proposal_id = $data['sdg_proposal_id'];
				$thn_akdmk_id    = $data['tahun_akademik_id'];
				$waktu_id        = $data['waktu_id'];
				$npm             = $data['npm'];
				$nama_lkp        = $data['nama_lkp'];
				$dpj_satu        = $data['dpj_satu'];
				$dpj_dua         = $data['dpj_dua'];
				$judul_proposal  = $data['judul_proposal'];
				$tanggal_sdg     = $data['tanggal_sdg'];
				$ruangan         = $data['ruangan'];
		?>
				<tr>
					<td><?= $no++ ?>.</td>
					<td><?= $npm ?></td>
					<td><?= $nama_lkp ?></td>
					<td><?= $judul_proposal ?></td>
					<td>
						<?php
						if (!empty($dpj_satu)) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$nama_dsn = strtoupper($data['nama_lkp']);

								if ($dpj_satu == $nidn) {
									echo  $nama_dsn;
								}
							endforeach;
						} else {
							echo "BELUM DITENTUKAN";
						}
						?>
					</td>
					<td>
						<?php
						if (!empty($dpj_dua)) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$nama_dsn = strtoupper($data['nama_lkp']);

								if ($dpj_dua == $nidn) {
									echo  $nama_dsn;
								}
							endforeach;
						} else {
							echo "BELUM DITENTUKAN";
						}
						?>
					</td>
					<td><?= $tanggal_sdg != null ? $tanggal_sdg : "BELUM DITENTUKAN" ?></td>
					<td>
						<?php
						if (!empty($waktu_id)) {
							foreach ($g_waktu as $data) :
								$id_waktu = $data['waktu_id'];
								$jam      = strtoupper($data['jam']);

								if ($waktu_id == $id_waktu) {
									echo $jam;
								}
							endforeach;
						} else {
							echo "BELUM DITENTUKAN";
						}
						?>
					</td>
					<td><?= $ruangan != null ? $ruangan : "BELUM DITENTUKAN" ?></td>
				</tr>
		<?php
			endforeach;
		} else {
			NULL;
		} ?>
	</tbody>
</table>

<br>

<table style="width:100%">
	<tbody>
		<tr>
			<td style="width:72%">&nbsp;</td>
			<td style="width:28%" align="center">
				Bekasi, <?= $d_tanggal ?>
				<br />
				Ketua Program Studi Teknik Informatika
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<strong><u><?= $kaprodi ?></u></strong>
			</td>
		</tr>
	</tbody>
</table>
